<?php
// Авторизованный пользователь. Подключаем всю структуру мероприятий из БД
if($USER)
{
  foreach(['u_champs', 'u_countries', 'u_langs', 'u_matches'] as $t)
  {
    $u_res = $DB->query("SELECT `p_id` from `users_data` WHERE `u_param`='{$t}' AND `user_id`={$USER['id']}");

    while($r = $u_res->fetch_array()) $CFG[$t][$r[0]] = 1;

    $u_res->free();

    // если у пользователя не было ничего выбрано, делаем пустую конфигурацию для этого параметра
    if(!$CFG[$t]) $CFG[$t] = array_fill_keys(array_keys($$t), 0);
  }

  foreach(['fname', 'bday', 'dt_in', 'dt_out', 'phone', 'sms', 'scn'] as $p) $CFG['u'][$p] = $USER[$p];
}
// Делаем чистую конфигурацию
else
{

  // Восстанавливаем конфигурацию, которая возможно была в случае, если пользователь закрыл окно,
  // а потом вернулся или не получилось зарегистрироваться.
  $cookie_cfg = json_decode($_COOKIE['cfg'], true);

  // Делаем чистую конфигурациб по списку для неавторизованного посетителя
  foreach(['u_champs'] as $t)
  {
    $CFG[$t] = $cookie_cfg[$t] ? $cookie_cfg[$t] : array_fill_keys(array_keys($$t), 0);
  }

  unset($cookie_cfg);
}

?>
    <script>
        var lng_param='<?=LNG_PARAM;?>', lng='<?=$LNG;?>';
        var lng_uri='<?=LNG_PARAM;?>=<?=$LNG;?>';
        var cfg = <?php print json_encode($CFG); ?>;
    </script>
