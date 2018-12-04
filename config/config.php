<?php
define('SITE_ROOT', "../");
define('WWW_ROOT', SITE_ROOT . '/public');

/* DB config */
define('HOST', 'php1.oleg');
define('USER', 'root');
define('PASS', '');
define('DB', 'images_bd');

define('DATA_DIR', SITE_ROOT . 'data');
define('LIB_DIR', SITE_ROOT . 'engine');
define('TPL_DIR', SITE_ROOT . 'templates');
define('IMG_DIR', WWW_ROOT . '/img');

define('SITE_TITLE', 'Урок 5');
//подгружаем основные функции
require_once(LIB_DIR . '/functions.php');
require_once(LIB_DIR . '/db.php');
require_once(LIB_DIR . '/log.php');

