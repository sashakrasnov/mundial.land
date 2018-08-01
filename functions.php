<?php

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die;

// Функция отправки письма в формате html в кодировке utf-8
function html_mail($to, $subj, $body, $from)
{
  $s = '=?utf-8?B?'.base64_encode($subj).'?=';

  return mail($to, $s, $body, "From: $from\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: 8bit\r\n", '-f'.$from);
}

// Функция забора данных по определенному адресу для протокола https
function get_curl_content($u)
{
  $c = curl_init();

  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);  // Will return the response, if false it print the response
  curl_setopt($c, CURLOPT_URL, $u);               // Set the url
  
  $r = curl_exec($c);                             // Execute

  curl_close($c);                                 // Closing

  return $r ? json_decode($r, $assoc = true) : null;
}

/**
  *  Работа с пользователями
  */

// Функция выбора пользователя
function get_landuser($k, $v)
{
  global $DB;

  $u = null;

  $auth_res = $DB->query("SELECT *, UNIX_TIMESTAMP()-UNIX_TIMESTAMP(`updated`) AS `uts_diff` FROM `users` WHERE `$k`='".$DB->escape_string($v)."'");

  if(!$auth_res)
  {
    printf(LNG_ERR_DB, $DB->errno);
    die;
  }

  if($auth_res->num_rows !== 0)
  {
    $u = $auth_res->fetch_assoc();
    $auth_res->free();
  }

  return $u;
}

function upd_landuser($auth_key, $k='', $v='')
{
  global $DB;

  $DB->query("UPDATE `users` SET ".($k ? "`$k`=$v, " : "")."`updated`=NOW() WHERE `auth_key`='$auth_key'");
}

function upd_landuser_time($auth_key)
{
  upd_landuser($auth_key);
}

function confirm_landuser($auth_key)
{
  upd_landuser($auth_key, 'confirmed', 1);
}

function put_landuser($email, $passw, $fname)
{
  global $DB;

  $sql_email = $DB->escape_string($email);
  $sql_fname = $DB->escape_string($fname);
  $sql_passw = md5($passw);
  //$sql_passw = password_hash($passw, PASSWORD_DEFAULT);
  $auth_key  = $DB->escape_string(md5($email.$passw.microtime(true)));

  $auth_res  = $DB->query("INSERT INTO `users` (`fname`, `email`, `passw`, `auth_key`, `ts`) VALUES ('$sql_fname', '$sql_email', '$sql_passw', '$auth_key', NOW())");

  return $auth_res ? $auth_key : null;
}

function cfg_landuser($user_id, $cfg_json, $sum=false)
{
  global $DB;

  $cfg = is_array($cfg_json) ? $cfg_json : json_decode($cfg_json, true); // массив или json?

  foreach($cfg as $c => $v)
  {
    if($c!='u')
    {
      if($sum)
      {
        $u_res = $DB->query("SELECT * FROM `users_data` WHERE `user_id`=$user_id AND `u_param`='$c'");

        while($u = $u_res->fetch_assoc()) $v[$u['p_id']] = 0; // обнуляем те, что уже есть в БД

        $u_res->free();
      }
      else
      {
        $DB->query("DELETE FROM `users_data` WHERE `user_id`=$user_id AND `u_param`='$c'");
      }
      foreach($v as $un => $uv) if($uv) $DB->query("INSERT INTO `users_data` (`user_id`, `u_param`, `p_id`) VALUES ($user_id, '$c', $un)");
    }
    else // доп. данные о пользователе
    {
      foreach($v as $un => $uv) $q[] = "`$un`=".($uv=='' ? 'NULL' : "'".$DB->escape_string($uv)."'");

      //print 'UPDATE `users` SET '.implode(', ', $q).' WHERE `id`='.$user_id;
      $DB->query('UPDATE `users` SET '.implode(', ', $q).' WHERE `id`='.$user_id);

      //$fname = $DB->escape_string($v['fname']);

      //$DB->query("UPDATE `users` SET `fname`='$fname', `sex`=".($v['sex']=='' ? 'NULL' : $v['sex']).", `bday`='{$v['bday']}', `dt_in`='{$v['dt_in']}', `dt_out`='{$v['dt_out']}', `phone`='{$v['phone']}', `sms`={$v['sms']}, `scn`={$v['scn']} WHERE `id`=".$user_id);
    }
  }
}

function cfg_unset()
{
  setcookie('cfg', '', time()-3600);
//  $_SESSION['cfg'] = $key;
}

function set_auth($key)
{
  if($key)
//    $_SESSION['token'] = $key;
    setcookie('token', $key, 0);
  else
//    unset($_SESSION['token']);
    setcookie('token', '', time()-3600);
}

function unset_auth()
{
  set_auth('');
}

function get_auth()
{
//  return $_SESSION['token'];
  return $_COOKIE['token'];
}

function date_range($first, $last, $step='+1 day', $format = 'Y-m-d' )
{
  $dates = [];

  $curr  = strtotime($first);
  $last  = strtotime($last);

  while($curr <= $last)
  {
     $dates[] = date($format, $curr);
     $curr = strtotime($step, $curr);
  }

  return $dates;
}

?>