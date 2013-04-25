<?php
require_once '../configu.php';
require_once '../include/functions.php';

$_SESSION['codesaur_login_return_url'] = $_SERVER['REQUEST_URI'];

checkUser();

$content      = 'list.php';        
$pageTitle    = AUTHORTTL . 'Бусад тохиргоо';
$contentTitle = 'Бусад тохиргоо';

$script = array('misc.js');
$currentMenu = 'Misc';

require_once '../include/control.php';
?>