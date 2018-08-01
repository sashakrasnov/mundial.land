<?php

$DB = new mysqli('localhost', 'root', '', 'mundial');

if($DB->connect_errno)
{
    printf(LNG_ERR_DB . PHP_EOL, $DB->connect_errno);
    die;
}

$DB->set_charset('utf8mb4');

?>