<?php

session_start();

error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Europe/Moscow');

/**
 *  Работа с языками
 */

define('LNG_PARAM', 'lang');
define('LNG_REDIRECT', false);
define('LNG_DEFAULT', 'ru');

$LANGS = ['ru'=>['name'=>'Русский',   'fb'=>'ru-ru.'],
          'en'=>['name'=>'English',   'fb'=>'en-gb.'],
          'de'=>['name'=>'Deutsch',   'fb'=>'de-de.'],
          'fr'=>['name'=>'Français',  'fb'=>'fr-fr.'],
          'es'=>['name'=>'Español',   'fb'=>'es-sp.'],
          'pt'=>['name'=>'Português', 'fb'=>'pt-br.']];

// Устанавливаем язык. Если в списке отсутствует, то берем язык "по-умолчанию"
$LNG = $LANGS[$_REQUEST[LNG_PARAM]] ? $_REQUEST[LNG_PARAM] : LNG_DEFAULT;

// Устанавливаем параметр для URL, который будем использовать во многих местах
$LNG_URI_PARAM = LNG_PARAM.'='.$LNG;

// Главная страница. На нее редиректим в некоторых случаях
$HOME_PAGE_LOC = 'Location: /?'.$LNG_URI_PARAM;

// Проверяем соответствует ли полученный язык, переданному через параметр методом GET
if($LNG != $_GET[LNG_PARAM] && $_GET[LNG_PARAM] != '' && LNG_REDIRECT)
{
    $_GET[LNG_PARAM] = $LNG;

    header('Location: ./?'.http_build_query($_GET), true, 301);
    exit;
}

// Подключаем локализацию
include  "langs/{$LNG}.php";

// Текущий адрес без строки параметров
$URI = explode('?', $_SERVER['REQUEST_URI'])[0];

/**
  *  Настройки для FB
  */

define('FB_APP_ID', '<place FB app id here>'); // Идентификатор приложения
define('FB_APP_SECRET', '<place FB app secret key here>'); // Секретный ключ приложения
define('FB_REDIRECT_URI', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$URI.'?task=fblogin&'.$LNG_URI_PARAM);
define('FB_AUTH_URI', 'https://www.facebook.com/v2.12/dialog/oauth?client_id='.FB_APP_ID.'&response_type=code');
define('FB_TOKEN_URI', 'https://graph.facebook.com/v2.12/oauth/access_token?client_id='.FB_APP_ID.'&client_secret='.FB_APP_SECRET);
define('FB_DATA_URI', 'https://graph.facebook.com/v2.12/me?fields=id,name,email');

/**
  *  Настройки для VK
  */

define('VK_APP_ID', '<place VK app id here>'); // Идентификатор приложения
define('VK_APP_SECRET', '<place VK scret key here>'); // Секретный ключ приложения
define('VK_REDIRECT_URI', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$URI.'?task=vklogin&'.$LNG_URI_PARAM);
define('VK_AUTH_URI', 'http://oauth.vk.com/authorize?client_id='.VK_APP_ID.'&response_type=code');
define('VK_TOKEN_URI', 'https://oauth.vk.com/access_token?client_id='.VK_APP_ID.'&client_secret='.VK_APP_SECRET);
define('VK_DATA_URI', 'https://api.vk.com/method/users.get?v=5.8&fields=uid,first_name,last_name,screen_name,email');

/**
  *  Общая структура данных
  */

// Города

$u_cities = [1 => LNG_CT_MSK,
             2 => LNG_CT_SOC,
             3 => LNG_CT_VOL,
             4 => LNG_CT_RND,
             5 => LNG_CT_KAZ,
             6 => LNG_CT_SAR,
             7 => LNG_CT_SPB,
             8 => LNG_CT_SAM,
             9 => LNG_CT_NOV,
            10 => LNG_CT_EKB,
            11 => LNG_CT_KLG];
//asort($u_cities);

// Страны

$u_countries = [1 => LNG_CN_ISL,
                2 => LNG_CN_SWE,
                3 => LNG_CN_DEN,
                4 => LNG_CN_RUS,
                5 => LNG_CN_ENG,
                6 => LNG_CN_POL,
                7 => LNG_CN_BEL,
                8 => LNG_CN_GER,
                9 => LNG_CN_FRA,
                10 => LNG_CN_SUI,
                11 => LNG_CN_CRO,
                12 => LNG_CN_SRB,
                13 => LNG_CN_ESP,
                14 => LNG_CN_POR,
                15 => LNG_CN_TUN,
                16 => LNG_CN_MAR,
                17 => LNG_CN_IRN,
                18 => LNG_CN_KOR,
                19 => LNG_CN_JPN,
                20 => LNG_CN_EGY,
                21 => LNG_CN_KSA,
                22 => LNG_CN_SEN,
                23 => LNG_CN_NGA,
                24 => LNG_CN_AUS,
                25 => LNG_CN_MEX,
                26 => LNG_CN_PAN,
                27 => LNG_CN_CRC,
                28 => LNG_CN_COL,
                29 => LNG_CN_PER,
                30 => LNG_CN_BRA,
                31 => LNG_CN_URU,
                32 => LNG_CN_ARG];
//asort($u_countries);

// Языки мероприятий

$u_langs = [1 => LNG_RUS,
            2 => LNG_ENG,
            3 => LNG_GER,
            4 => LNG_FRA,
            5 => LNG_ESP,
            6 => LNG_POR];
//asort($u_langs);

// Мероприятия

$u_champs = [1 => LNG_CM_FBL,
             2 => LNG_CM_MFB,
             3 => LNG_CM_VLB,
             4 => LNG_CM_HNB,
             5 => LNG_CM_BSB,
             6 => LNG_CM_LST];
//asort($u_champs);

$u_matches = [1 => ['dt' => '2018-06-14', 'hm'=> '18:00', 't1' => LNG_CN_RUS, 't2' => LNG_CN_KSA, 'ct' => LNG_CT_MSK, 'gr' => 'A'],
              2 => ['dt' => '2018-06-15', 'hm'=> '17:00', 't1' => LNG_CN_EGY, 't2' => LNG_CN_URU, 'ct' => LNG_CT_EKB, 'gr' => 'A'],
              3 => ['dt' => '2018-06-15', 'hm'=> '21:00', 't1' => LNG_CN_POR, 't2' => LNG_CN_ESP, 'ct' => LNG_CT_SOC, 'gr' => 'B'],
              4 => ['dt' => '2018-06-15', 'hm'=> '18:00', 't1' => LNG_CN_MAR, 't2' => LNG_CN_IRN, 'ct' => LNG_CT_SPB, 'gr' => 'B'],
              5 => ['dt' => '2018-06-16', 'hm'=> '13:00', 't1' => LNG_CN_FRA, 't2' => LNG_CN_AUS, 'ct' => LNG_CT_KAZ, 'gr' => 'C'],
              6 => ['dt' => '2018-06-16', 'hm'=> '19:00', 't1' => LNG_CN_PER, 't2' => LNG_CN_DEN, 'ct' => LNG_CT_SAR, 'gr' => 'C'],
              7 => ['dt' => '2018-06-16', 'hm'=> '16:00', 't1' => LNG_CN_ARG, 't2' => LNG_CN_ISL, 'ct' => LNG_CT_MSK, 'gr' => 'D'],
              8 => ['dt' => '2018-06-16', 'hm'=> '21:00', 't1' => LNG_CN_CRO, 't2' => LNG_CN_NGA, 'ct' => LNG_CT_KLG, 'gr' => 'D'],
              9 => ['dt' => '2018-06-17', 'hm'=> '21:00', 't1' => LNG_CN_BRA, 't2' => LNG_CN_SUI, 'ct' => LNG_CT_RND, 'gr' => 'E'],
             10 => ['dt' => '2018-06-17', 'hm'=> '16:00', 't1' => LNG_CN_CRC, 't2' => LNG_CN_SRB, 'ct' => LNG_CT_SAM, 'gr' => 'E'],
             11 => ['dt' => '2018-06-17', 'hm'=> '18:00', 't1' => LNG_CN_GER, 't2' => LNG_CN_MEX, 'ct' => LNG_CT_MSK, 'gr' => 'F'],
             12 => ['dt' => '2018-06-18', 'hm'=> '15:00', 't1' => LNG_CN_SWE, 't2' => LNG_CN_KOR, 'ct' => LNG_CT_NOV, 'gr' => 'F'],
             13 => ['dt' => '2018-06-18', 'hm'=> '18:00', 't1' => LNG_CN_BEL, 't2' => LNG_CN_PAN, 'ct' => LNG_CT_SOC, 'gr' => 'G'],
             14 => ['dt' => '2018-06-18', 'hm'=> '21:00', 't1' => LNG_CN_TUN, 't2' => LNG_CN_ENG, 'ct' => LNG_CT_VOL, 'gr' => 'G'],
             15 => ['dt' => '2018-06-19', 'hm'=> '18:00', 't1' => LNG_CN_POL, 't2' => LNG_CN_SEN, 'ct' => LNG_CT_MSK, 'gr' => 'H'],
             16 => ['dt' => '2018-06-19', 'hm'=> '15:00', 't1' => LNG_CN_COL, 't2' => LNG_CN_JPN, 'ct' => LNG_CT_SAR, 'gr' => 'H'],
             17 => ['dt' => '2018-06-19', 'hm'=> '21:00', 't1' => LNG_CN_RUS, 't2' => LNG_CN_EGY, 'ct' => LNG_CT_SPB, 'gr' => 'A'],
             18 => ['dt' => '2018-06-20', 'hm'=> '18:00', 't1' => LNG_CN_URU, 't2' => LNG_CN_KSA, 'ct' => LNG_CT_RND, 'gr' => 'A'],
             19 => ['dt' => '2018-06-20', 'hm'=> '15:00', 't1' => LNG_CN_POR, 't2' => LNG_CN_MAR, 'ct' => LNG_CT_MSK, 'gr' => 'B'],
             20 => ['dt' => '2018-06-20', 'hm'=> '21:00', 't1' => LNG_CN_IRN, 't2' => LNG_CN_ESP, 'ct' => LNG_CT_KAZ, 'gr' => 'B'],
             21 => ['dt' => '2018-06-21', 'hm'=> '20:00', 't1' => LNG_CN_FRA, 't2' => LNG_CN_PER, 'ct' => LNG_CT_EKB, 'gr' => 'C'],
             22 => ['dt' => '2018-06-21', 'hm'=> '16:00', 't1' => LNG_CN_DEN, 't2' => LNG_CN_AUS, 'ct' => LNG_CT_SAM, 'gr' => 'C'],
             23 => ['dt' => '2018-06-21', 'hm'=> '21:00', 't1' => LNG_CN_ARG, 't2' => LNG_CN_CRO, 'ct' => LNG_CT_NOV, 'gr' => 'D'],
             24 => ['dt' => '2018-06-22', 'hm'=> '18:00', 't1' => LNG_CN_NGA, 't2' => LNG_CN_ISL, 'ct' => LNG_CT_VOL, 'gr' => 'D'],
             25 => ['dt' => '2018-06-22', 'hm'=> '15:00', 't1' => LNG_CN_BRA, 't2' => LNG_CN_CRC, 'ct' => LNG_CT_SPB, 'gr' => 'E'],
             26 => ['dt' => '2018-06-22', 'hm'=> '20:00', 't1' => LNG_CN_SRB, 't2' => LNG_CN_SUI, 'ct' => LNG_CT_KLG, 'gr' => 'E'],
             27 => ['dt' => '2018-06-23', 'hm'=> '21:00', 't1' => LNG_CN_GER, 't2' => LNG_CN_SWE, 'ct' => LNG_CT_SOC, 'gr' => 'F'],
             28 => ['dt' => '2018-06-23', 'hm'=> '18:00', 't1' => LNG_CN_KOR, 't2' => LNG_CN_MEX, 'ct' => LNG_CT_RND, 'gr' => 'F'],
             29 => ['dt' => '2018-06-23', 'hm'=> '15:00', 't1' => LNG_CN_BEL, 't2' => LNG_CN_TUN, 'ct' => LNG_CT_MSK, 'gr' => 'G'],
             30 => ['dt' => '2018-06-24', 'hm'=> '15:00', 't1' => LNG_CN_ENG, 't2' => LNG_CN_PAN, 'ct' => LNG_CT_NOV, 'gr' => 'G'],
             31 => ['dt' => '2018-06-24', 'hm'=> '21:00', 't1' => LNG_CN_POL, 't2' => LNG_CN_COL, 'ct' => LNG_CT_KAZ, 'gr' => 'H'],
             32 => ['dt' => '2018-06-24', 'hm'=> '20:00', 't1' => LNG_CN_JPN, 't2' => LNG_CN_SEN, 'ct' => LNG_CT_EKB, 'gr' => 'H'],
             33 => ['dt' => '2018-06-25', 'hm'=> '18:00', 't1' => LNG_CN_URU, 't2' => LNG_CN_RUS, 'ct' => LNG_CT_SAM, 'gr' => 'A'],
             34 => ['dt' => '2018-06-25', 'hm'=> '17:00', 't1' => LNG_CN_KSA, 't2' => LNG_CN_EGY, 'ct' => LNG_CT_VOL, 'gr' => 'A'],
             35 => ['dt' => '2018-06-25', 'hm'=> '21:00', 't1' => LNG_CN_IRN, 't2' => LNG_CN_POR, 'ct' => LNG_CT_SAR, 'gr' => 'B'],
             36 => ['dt' => '2018-06-25', 'hm'=> '20:00', 't1' => LNG_CN_ESP, 't2' => LNG_CN_MAR, 'ct' => LNG_CT_KLG, 'gr' => 'B'],
             37 => ['dt' => '2018-06-26', 'hm'=> '17:00', 't1' => LNG_CN_DEN, 't2' => LNG_CN_FRA, 'ct' => LNG_CT_MSK, 'gr' => 'C'],
             38 => ['dt' => '2018-06-26', 'hm'=> '17:00', 't1' => LNG_CN_AUS, 't2' => LNG_CN_PER, 'ct' => LNG_CT_SOC, 'gr' => 'C'],
             39 => ['dt' => '2018-06-26', 'hm'=> '21:00', 't1' => LNG_CN_NGA, 't2' => LNG_CN_ARG, 'ct' => LNG_CT_SPB, 'gr' => 'D'],
             40 => ['dt' => '2018-06-26', 'hm'=> '21:00', 't1' => LNG_CN_ISL, 't2' => LNG_CN_CRO, 'ct' => LNG_CT_RND, 'gr' => 'D'],
             41 => ['dt' => '2018-06-27', 'hm'=> '21:00', 't1' => LNG_CN_SRB, 't2' => LNG_CN_BRA, 'ct' => LNG_CT_MSK, 'gr' => 'E'],
             42 => ['dt' => '2018-06-27', 'hm'=> '21:00', 't1' => LNG_CN_SUI, 't2' => LNG_CN_CRC, 'ct' => LNG_CT_NOV, 'gr' => 'E'],
             43 => ['dt' => '2018-06-27', 'hm'=> '17:00', 't1' => LNG_CN_KOR, 't2' => LNG_CN_GER, 'ct' => LNG_CT_KAZ, 'gr' => 'F'],
             44 => ['dt' => '2018-06-27', 'hm'=> '19:00', 't1' => LNG_CN_MEX, 't2' => LNG_CN_SWE, 'ct' => LNG_CT_EKB, 'gr' => 'F'],
             45 => ['dt' => '2018-06-28', 'hm'=> '20:00', 't1' => LNG_CN_ENG, 't2' => LNG_CN_BEL, 'ct' => LNG_CT_KLG, 'gr' => 'G'],
             46 => ['dt' => '2018-06-28', 'hm'=> '21:00', 't1' => LNG_CN_PAN, 't2' => LNG_CN_TUN, 'ct' => LNG_CT_SAR, 'gr' => 'G'],
             47 => ['dt' => '2018-06-28', 'hm'=> '17:00', 't1' => LNG_CN_JPN, 't2' => LNG_CN_POL, 'ct' => LNG_CT_VOL, 'gr' => 'H'],
             48 => ['dt' => '2018-06-28', 'hm'=> '18:00', 't1' => LNG_CN_SEN, 't2' => LNG_CN_COL, 'ct' => LNG_CT_SAM, 'gr' => 'H'],
             49 => ['dt' => '2018-06-30', 'hm'=> '21:00', 't1' => '1A', 't2' => '2B', 'ct' => LNG_CT_SOC, 'gr'=> '8'],
             50 => ['dt' => '2018-06-30', 'hm'=> '17:00', 't1' => '1C', 't2' => '2D', 'ct' => LNG_CT_KAZ, 'gr'=> '8'],
             51 => ['dt' => '2018-07-01', 'hm'=> '17:00', 't1' => '1B', 't2' => '2A', 'ct' => LNG_CT_MSK, 'gr'=> '8'],
             52 => ['dt' => '2018-07-01', 'hm'=> '21:00', 't1' => '1D', 't2' => '2C', 'ct' => LNG_CT_NOV, 'gr'=> '8'],
             53 => ['dt' => '2018-07-02', 'hm'=> '18:00', 't1' => '1E', 't2' => '2F', 'ct' => LNG_CT_SAM, 'gr'=> '8'],
             54 => ['dt' => '2018-07-02', 'hm'=> '21:00', 't1' => '1G', 't2' => '2H', 'ct' => LNG_CT_RND, 'gr'=> '8'],
             55 => ['dt' => '2018-07-03', 'hm'=> '17:00', 't1' => '1F', 't2' => '2E', 'ct' => LNG_CT_SPB, 'gr'=> '8'],
             56 => ['dt' => '2018-07-03', 'hm'=> '21:00', 't1' => '1H', 't2' => '2G', 'ct' => LNG_CT_MSK, 'gr'=> '8'],
             57 => ['dt' => '2018-07-06', 'hm'=> '17:00', 't1' => 'W49', 't2' => 'W50', 'ct' => LNG_CT_NOV, 'gr'=> '4'],
             58 => ['dt' => '2018-07-06', 'hm'=> '21:00', 't1' => 'W53', 't2' => 'W54', 'ct' => LNG_CT_KAZ, 'gr'=> '4'],
             59 => ['dt' => '2018-07-07', 'hm'=> '21:00', 't1' => 'W51', 't2' => 'W52', 'ct' => LNG_CT_SOC, 'gr'=> '4'],
             60 => ['dt' => '2018-07-07', 'hm'=> '18:00', 't1' => 'W55', 't2' => 'W56', 'ct' => LNG_CT_SAM, 'gr'=> '4'],
             61 => ['dt' => '2018-07-10', 'hm'=> '21:00', 't1' => 'W57', 't2' => 'W58', 'ct' => LNG_CT_SPB, 'gr'=> '2'],
             62 => ['dt' => '2018-07-11', 'hm'=> '21:00', 't1' => 'W59', 't2' => 'W60', 'ct' => LNG_CT_MSK, 'gr'=> '2'],
             63 => ['dt' => '2018-07-14', 'hm'=> '17:00', 't1' => 'L61', 't2' => 'L62', 'ct' => LNG_CT_SPB, 'gr'=> '0'],
             64 => ['dt' => '2018-07-15', 'hm'=> '18:00', 't1' => 'W61', 't2' => 'W62', 'ct' => LNG_CT_MSK, 'gr'=> '1']];

?>