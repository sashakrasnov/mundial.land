<?php

/**
 *  Файл перевода на русский язык
 */

// Ошибки

define('LNG_ERR_DB', 'Ошибка %s: Невозможно установить соединение с MySQL.');
define('LNG_ERR_LOGIN_WRONG', 'Пользователя с таким адресом не существует или пароль указан неверно.');
define('LNG_ERR_LOGIN_USED', 'Пользователь с адресом электронной почты "%s" уже существует.');
define('LNG_ERR_LOGIN_NOTUSED', 'Пользователя с адресом электронной почты "%s" не существует.');
define('LNG_ERR_LOGIN_CONFIRM', 'На адрес "%s" было отправлено контрольное письмо. Пожалуйста, откройте его и перейдите по ссылке, которая указана в этом письме для подтверждения учетной записи. Если вы не получили письмо, проверьте пожалуйста папку "спам". Если письмо все-таки не приходит, то вы можете повторно его отправить перейдя по <a href="%s">этой ссылке</a>');
define('LNG_ERR_LOGIN_RESEND', 'Повторное письмо было отправлено на адрес "%s". Пожалуйста, откройте его и перейдите по ссылке, которая указана в этом письме для подтверждения своей учетной записи. Если вы не получили письмо, проверьте пожалуйста папку "спам". Если письмо все-таки не приходит, то вы можете повторно его отправить перейдя по <a href="%s">этой ссылке</a>');
define('LNG_ERR_LOGIN_DELAY', '<p class="msg_delay">Вы можете отправить повторное сообщение для подтверждения учетной записи только через <span id="countdown">%s</span> секунд.</p><p class="msg_delay_proceed">Для повторной отправки письма для подтверждения вашей учетной записи перейдте по <a href="%s">этой ссылке</a>.</p>');
define('LNG_ERR_LOGIN_FNAME', 'Имя должно состоять по крайней мере из 4-х символов.');
define('LNG_ERR_LOGIN_EMAIL', 'Неправильный адрес электронной почты');
define('LNG_ERR_LOGIN_PASSW', 'Пароль должен состоять из 8 и более символов, содержащих буквы латинского алфавита, цифры и хотя бы одну заглавную букву.');
define('LNG_ERR_LOGIN_EMPTY', 'Необходимо ввести е-мейл и пароль.');
define('LNG_ERR_UPDATE_AJAX', 'Ошибка обновления');


// Основное

define('LNG_SITE_TITLE', 'Двенадцатый игрок');
define('LNG_MONTHES', [6=>'Июня', 7=>'Июля']);
define('LNG_WEEKDAYS', ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']);

// Города

define('LNG_CT_MSK', 'Москва');
define('LNG_CT_SOC', 'Сочи');
define('LNG_CT_VOL', 'Волгоград');
define('LNG_CT_RND', 'Ростов-на-Дону');
define('LNG_CT_KAZ', 'Казань');
define('LNG_CT_SAR', 'Саранск');
define('LNG_CT_SPB', 'Санкт-Петербург');
define('LNG_CT_SAM', 'Самара');
define('LNG_CT_NOV', 'Нижний Новгород');
define('LNG_CT_EKB', 'Екатеринбург');
define('LNG_CT_KLG', 'Калининград');

// Страны

define('LNG_CN_ISL', 'Исландия');
define('LNG_CN_SWE', 'Швеция');
define('LNG_CN_DEN', 'Дания');
define('LNG_CN_RUS', 'Россия');
define('LNG_CN_ENG', 'Англия');
define('LNG_CN_POL', 'Польша');
define('LNG_CN_BEL', 'Бельгия');
define('LNG_CN_GER', 'Германия');
define('LNG_CN_FRA', 'Франция');
define('LNG_CN_SUI', 'Швейцария');
define('LNG_CN_CRO', 'Хорватия');
define('LNG_CN_SRB', 'Сербия');
define('LNG_CN_ESP', 'Испания');
define('LNG_CN_POR', 'Португалия');
define('LNG_CN_TUN', 'Тунис');
define('LNG_CN_MAR', 'Марокко');
define('LNG_CN_IRN', 'Иран');
define('LNG_CN_KOR', 'Корея');
define('LNG_CN_JPN', 'Япония');
define('LNG_CN_EGY', 'Египет');
define('LNG_CN_KSA', 'Саудовская Аравия');
define('LNG_CN_SEN', 'Сенегал');
define('LNG_CN_NGA', 'Нигерия');
define('LNG_CN_AUS', 'Австралия');
define('LNG_CN_MEX', 'Мексика');
define('LNG_CN_PAN', 'Панама');
define('LNG_CN_CRC', 'Коста-Рика');
define('LNG_CN_COL', 'Колумбия');
define('LNG_CN_PER', 'Перу');
define('LNG_CN_BRA', 'Бразилия');
define('LNG_CN_URU', 'Уругвай');
define('LNG_CN_ARG', 'Аргентина');

// Языки мероприятий

define('LNG_RUS', 'Русский');
define('LNG_ENG', 'Английский');
define('LNG_GER', 'Немецкий');
define('LNG_FRA', 'Французский');
define('LNG_ESP', 'Испанский');
define('LNG_POR', 'Португальский');

// Мерориятия

define('LNG_CM_FBL', ['Футбол',
                      '',
                      '']);
define('LNG_CM_MFB', ['Мини-футбол',
                      '',
                      '']);
define('LNG_CM_VLB', ['Волейбол',
                      '',
                      '']);
define('LNG_CM_HNB', ['Гандбол',
                      '',
                      '']);
define('LNG_CM_BSB', ['Баскетбол',
                      '',
                      '']);
define('LNG_CM_LST', ['Лазертаг',
                      '',
                      '']);

// Регистрационная форма

define('LNG_BTN_LOGIN', 'Войти');
define('LNG_BTN_REGISTER', 'Зарегистрироваться');
define('LNG_FULLNAME', 'Имя и фамилия');
define('LNG_EMAIL', 'E-mail адрес');
define('LNG_PASSW', 'Пароль');
define('LNG_PHONE', 'Телефон');
define('LNG_SMS', 'Уведомлять через SMS');
define('LNG_SCN', 'Уведомлять через FB и VK');
define('LNG_BIRTHDAY', 'Дата рождения');
define('LNG_DATE_IN', 'Дата приезда');
define('LNG_DATE_OUT', 'Дата отъезда');
define('LNG_DT_PLACEHOLDER', 'ГГГГ-ММ-ДД');

define('LNG_FB_LOGIN', 'Войти с помощью FB');
define('LNG_VK_LOGIN', 'Войти с помощью VK');

define('LNG_EML_FROM', '"Мундиаль 2018" <robot@mundial>');
define('LNG_EML_SUBJECT', 'Подтверждение учетной записи');
define('LNG_EML_BODY', '<p>Здравствуйте %s,</p><p>Необходимо подтвердить вашу учетную запись. Для этого перейдите по <a href="%s">этой ссылке</a>.</p>');




?>