<?php

define('SALT_KEY', '');
define('RESEND_TIMEOUT', 5*60); // таймаут для повторной попытки отправить контрольное письмо в секундах

include 'cfg.php';
include 'functions.php';

// Есть ключ авторизации
if(get_auth())
{
  include 'db.php'; // БД подключаем только для получения данных, при условии, что есть авторизация

  if($u = get_landuser('auth_key', get_auth())) // есть такой пользователь
  {
    $tmo = RESEND_TIMEOUT - $u['uts_diff']; // таймаут
    $url = 'javascript: mail_resend();';

    if($tmo <= 0)
    {
      $msg = sprintf(LNG_EML_BODY, $u['full_name'], $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'?token='.$u['auth_key'].'&task=confirm&'.$LNG_URI_PARAM);

//      html_mail($u['email'], LNG_EML_SUBJECT, $msg, LNG_EML_FROM);
      upd_landuser_time($u['auth_key']);

      printf(LNG_ERR_LOGIN_RESEND, $u['email'], $url);
    }
    else
    {
      printf(LNG_ERR_LOGIN_DELAY, $tmo, $url);

?>
<style>
.msg_delay_proceed {
    display: none;
}
</style>
<script>
var countdown = $('.msg_delay #countdown'), timer;
function startCountdown()
{
  var startFrom = <?=$tmo;?>;

  timer = setInterval(function() {
      countdown.text(--startFrom);
      if(startFrom <= 0) {
          clearInterval(timer);
          $('.msg_delay').hide();
          $('.msg_delay_proceed').show();
      }
  }, 1000);

}
startCountdown();
</script>
<?php
    }
  }

  $DB->close();
}
else print('No authority');

?>