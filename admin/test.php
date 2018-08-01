<?php

define('SALT_KEY', 'asdfgh');

function url_make($url_query, $key=true)
{
    if($key) $url_query .= '&key='.bin2hex(random_bytes(4)); //microtime(true)

    return $url_query.'&confirm='.md5($url_query.SALT_KEY);
}

function url_check($url_query, $sep='&')
{
    $confirm = '';
    $args = [];

    foreach(explode($sep, $url_query) as $chunk)
    {
        if($param = array_map('urldecode',  explode('=', $chunk, 2)))
        {
            var_dump($param);
            if($param[0] == 'confirm')
                $confirm = $param[1];
            else
                $args[] = $param[0].'='.$param[1];
        }
    }

    return md5(implode($sep, $args).SALT_KEY) == $confirm;
}

//var_dump($_SERVER);

$u = url_make('aaa=ccc&bbb==ddd');
print $u.'<br>';

print url_check($u);

?>