<?php

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die;

/**
 *  Аутентификация и создание аккаунтов
 */

define('SALT_KEY', '');
define('RESEND_TIMEOUT', 5*60); // таймаут для повторной попытки отправить контрольное письмо в секундах
//define('RESEND_URI', '?task=resend&'.$LNG_URI_PARAM);
define('RESEND_URI', 'javascript: mail_resend();');

// Есть ключ авторизации
if(get_auth())
{
  include 'db.php'; // БД подключаем только для получения данных, при условии, что есть авторизация

  if($USER = get_landuser('auth_key', get_auth()))
  {
    // Пользователь с неподтвержденным емейлом. Выставляем собщение о том, что надо бы его подтердить
    if(!$USER['confirmed'])
    {
      $LOGIN_MSG = sprintf(LNG_ERR_LOGIN_CONFIRM, $USER['email'], RESEND_URI);
    }
  }
  else
  {
    unset_auth(); // снимаем ключ авторизации, т.к. по каким-то причинам не удалось найти пользователя
  }
}
//else {

// Авторизация через VK

if($_GET['task'] === 'vklogin')
{
  // Нас нормально авторизовали, сигнатура совпадает и есть "код"
  if($_GET['state'] === session_id() && $_GET['code'])
  {
    $resp = get_curl_content(VK_TOKEN_URI.'&redirect_uri='.urlencode(VK_REDIRECT_URI).'&code='.$_GET['code']);

    if($vk_token = $resp['access_token'])
    {
      $vk_data = get_curl_content(VK_DATA_URI.'&user_ids='.$resp['user_id'].'&access_token='.$vk_token);
      
      if($vk_data['response'][0]) // Есть ответ
      {
        include 'db.php';

        // Повторный вход, в БД такой пользователь уже есть
        if($u = get_landuser('vk_id', $resp['user_id']))
        {
           set_auth($u['auth_key']);
           cfg_landuser($u['id'], $_COOKIE['cfg'], true);
           upd_landuser_time($u['auth_key']);

           cfg_unset();
        }
        // Новый пользователь. Добавляем в БД
        else
        {
           $auth_key = put_landuser($resp['email'], $resp['user_id'], trim($vk_data['response'][0]['first_name'].' '.$vk_data['response'][0]['last_name']));

           cfg_landuser($DB->insert_id, $_COOKIE['cfg']);
           upd_landuser($auth_key, 'vk_id', $resp['user_id']);

           // отправить письмо о регистрации и подтверждении. Пока сразу все подтверждаем и редиректим

           set_auth($auth_key);
           cfg_unset();
        }

        header($HOME_PAGE_LOC);
        exit;
      }
      else
      {
        $LOGIN_MSG = LNG_VKLOGIN_ERROR; // Ошибка состояния, что-то не получилось
      }
    }
    else
    {
      $LOGIN_MSG = LNG_VKLOGIN_ERROR; // Ошибка состояния, не получилось забрать данные код доступа поэкспайрился
    }
  }
  else
  {
    $LOGIN_MSG = LNG_VKLOGIN_ERROR; // Ошибка состояния, скорее всего побирают руками или отказались
  }
}

// Авторизация через FB

if($_GET['task'] === 'fblogin')
{
  // Нас нормально авторизовали, сигнатура совпадает и есть "код"
  if($_GET['state'] === session_id() && $_GET['code'])
  {
    $resp = get_curl_content(FB_TOKEN_URI.'&redirect_uri='.urlencode(FB_REDIRECT_URI).'&code='.$_GET['code']);

    if($fb_token = $resp['access_token'])
    {
      $fb_data = get_curl_content(FB_DATA_URI.'&access_token='.$fb_token);

      if($fb_data['id'] && $fb_data['name'] && $fb_data['email'])
      {
        include 'db.php';

        // Повторный вход, в БД такой пользователь уже есть
        if($u = get_landuser('fb_id', $fb_data['id']))
        {
           set_auth($u['auth_key']);
           cfg_landuser($u['id'], $_COOKIE['cfg'], true);
           upd_landuser_time($u['auth_key']);

           cfg_unset();
        }
        // Новый пользователь. Добавляем в БД
        else
        {
           $auth_key = put_landuser($fb_data['email'], $fb_data['id'], $fb_data['name']);

           cfg_landuser($DB->insert_id, $_COOKIE['cfg']);
           upd_landuser($auth_key, 'fb_id', $fb_data['id']);

           // отправить письмо о регистрации и подтверждении. Пока сразу все подтверждаем и редиректим

           set_auth($auth_key);
           cfg_unset();
        }

        header($HOME_PAGE_LOC);
        exit;
      }
      else
      {
        $LOGIN_MSG = LNG_FBLOGIN_ERROR; // Ошибка состояния, что-то не получилось
      }
    }
    else
    {
      $LOGIN_MSG = LNG_FBLOGIN_ERROR; // Ошибка состояния, не получилось забрать данные код доступа поэкспайрился
    }
  }
  else
  {
    $LOGIN_MSG = LNG_FBLOGIN_ERROR; // Ошибка состояния, скорее всего побирают руками или отказались
  }
}

// выход из системы

if($_GET['task'] === 'logout') // выход из системы
{
  unset_auth();

  header($HOME_PAGE_LOC);
  exit;
}

// Подтверждение аккаунта

if($_GET['task'] === 'confirm')
{
  include 'db.php';

  if($u = get_landuser('auth_key', $_GET['token'])) // есть такой пользователь
  {
    confirm_landuser($u['auth_key']);
    set_auth($u['auth_key']);

    header($HOME_PAGE_LOC);
    exit;
  }
}

// повторная отправка письма
/*
if($_GET['task'] === 'resend')
{
  include 'db.php';

  if($u = get_landuser('auth_key', get_auth())) // есть такой пользователь
  {
    $tmo = RESEND_TIMEOUT - $u['uts_diff']; // таймаут

    if($tmo <= 0)
    {
      $msg = sprintf(LNG_EML_BODY, $u['full_name'], $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'?token='.$u['auth_key'].'&task=confirm&'.$LNG_URI_PARAM);

//      html_mail($u['email'], LNG_EML_SUBJECT, $msg, LNG_EML_FROM);
      upd_landuser_time($u['auth_key']);

      $LOGIN_MSG = sprintf(LNG_ERR_LOGIN_RESEND, $u['email'], RESEND_URI);
    }
    else
    {
      $LOGIN_MSG = sprintf(LNG_ERR_LOGIN_DELAY, $tmo, RESEND_URI);
    }
  }
}
*/

// регистрация или повторный вход
if($_REQUEST['task'] === 'login' || $_REQUEST['task'] === 'register') // логин или регистрация?
{
  if($_POST['email'] && $_POST['passw'])
  {
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== false)
    {
      include 'db.php';

      if($u = get_landuser('email', $_POST['email'])) // есть такой пользователь
      {
        if($_REQUEST['task'] == 'login') // была попытка простого входа
        {
          //if(password_verify($_POST['passw'], $u['passw']))
          if(hash_equals(md5($_POST['passw'].SALT_KEY), $u['passw'])) // пароль совпадает
          {
            cfg_landuser($u['id'], $_COOKIE['cfg'], true);
            upd_landuser_time($u['auth_key']);

            set_auth($u['auth_key']);
            cfg_unset();

            header($HOME_PAGE_LOC);
            exit;
          }
          else // неправильный пароль
          {
            $LOGIN_MSG = LNG_ERR_LOGIN_WRONG;
          }
        }
        // была попытка регистрации пользователя с существующим логином
        if($_REQUEST['task'] == 'register')
        {
          $LOGIN_MSG = sprintf(LNG_ERR_LOGIN_USED, $u['email']);
        }
      }
      // пользователь не найден
      else
      {
        // попытка логиниться
        if($_REQUEST['task'] == 'login')
        {
          $LOGIN_MSG = sprintf(LNG_ERR_LOGIN_NOTUSED, $_POST['email']);
        }
        // попытка регистрации
        if($_REQUEST['task'] == 'register')
        {
          if(preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $_POST['passw']))
          {
            $auth_key = put_landuser($_POST['email'], $_POST['passw'].SALT_KEY, $_POST['full_name']);
            cfg_landuser($DB->insert_id, $_COOKIE['cfg']);

            set_auth($auth_key);
            cfg_unset();

            header($HOME_PAGE_LOC);
            exit;
          }
          else
          {
            $LOGIN_MSG = LNG_ERR_LOGIN_PASSW;
          }
        }
      }
    }
    else
    {
      $LOGIN_MSG = LNG_ERR_LOGIN_EMAIL;
    }
  }
  else
  {
    $LOGIN_MSG = LNG_ERR_LOGIN_EMPTY;
  }
}

//}
?>