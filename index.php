<?php

include 'cfg.php';
include 'functions.php';

include 'auth.php'; // Авторизация. Проверям есть ли. Также обрабатывает запросы от соцсетей и подтверждение е-мейла

?>
<!DOCTYPE html lang="<?=$LNG;?>">
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
    <script src="/js/jquery.cookie.js"></script>
    <script src="/js/functions.js"></script>
<?php

include 'js.cfg.php';  // JS-конфигурация, зависимая от авторизации
include 'js.func.php'; // JS-функции, зависимые от авторизации

?>
    <title><?=LNG_SITE_TITLE;?></title>
</head>
<body>
    <div id="land-form">
<?php

if($CFG) foreach($CFG as $C => $V)
{
  include 'tmpl/'.$C.'.php';
}

include 'tmpl/auth.text.php';   // Внедрение сообщения при логине. Сюда же будут другие ошибки возвращаться
include 'tmpl/auth.form.php';   // Подключаем форму аутентификации
include 'tmpl/auth.logout.php'; // Подключаем форму для выхода из системы

?>
    </div>
    <style>
        .checked {color:red;}
        .checkable {cursor: pointer;}
    </style>
</body>
</html>
<?php

if($DB) $DB->close();

?>