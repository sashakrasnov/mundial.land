<?php

include 'cfg.php';
include 'functions.php';

//print_r($_POST);

if(get_auth())
{
  include 'db.php';

  if($u = get_landuser('auth_key', get_auth()))
  {
    cfg_landuser($u['id'], $_POST);

    $res = LNG_SAVE_OK;
  }
  else
  {
    $res = LNG_ERR_UPDATE_AJAX;
  }
}
else
{
  $res = LNG_ERR_UPDATE_AJAX;
}

$DB->close();

print $res;

?>