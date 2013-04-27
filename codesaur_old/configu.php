<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);
session_start();

// Вебийн тохиргоо
$webRoot = 'http://localhost/energysaures/';
$cmsDir = 'codesaur_old/';
$defaultCMS = 'menu/';
$charsetIso = 'utf-8';
$languages = array('mn', 'en');
$deflangind = 0;

define('DESCRIPTION', 'www energymongolia mn');
define('KEYWORDS', 'Energy, mongolia');

// Админ хандсан статистик үзүүлэх
define('SHOW_COUNTER', FALSE);
define('SHOW_COUNTER_DELAY', 5);

// Мэдээллийн сангын тохиргоо
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'energymo_db';

// Хэрэглэгчийн файл хуулах хавтас
define('MENU_IMAGES_DIR', 'public/menu/');
define('BANNER_IMAGES_DIR', 'public/banner/');

// Зургын файлын тохируулга
define('NO_IMAGE', $cmsDir . 'include/images/no-image.gif');
define('LIMIT_IMG_WIDTH', FALSE);
define('MAX_IMAGE_WIDTH', 500);
define('THUMBNAIL_WIDTH', 100);

// Хуудасны төрөл
$menuType = array(
    'home' => 'Home',
    'menu' => 'Menu',
    'quick' => 'Contact (quick)'
);

define('DEFAULT_MENU_KEY', 'menu');

define('UNKNOWN_ID', '325874365');
define('UNKNOWN_MN', 'Тодорхойгүй');
define('UNKNOWN_EN', 'Unknown');

// Техтүүд
$btnEditCaption = 'Zasah';
$btnDeleteCaption = 'Ustgah';
$msgError = 'Uuchlaarai.';
$msgNotice = 'Yasan?';
$msgSuccess = 'Ashgui!';

// HTML засагч
define('HTML_EDITOR', 'ckeditor');
define('HTML_EDITOR_PATH', '../thirdparty/CKEditor/ckeditor.js');

// Үндсэн сангын файлууд дуудах
require_once 'default.php';
require_once 'database.php';
require_once 'common.php';
?>