<?php
require_once 'configu.php';
require_once 'include/functions.php';

checkUser();

$content = 'main.php';
$pageTitle = AUTHORTTL . 'Aгуулга удирдах систем';
$contentTitle = '';
$currentMenu = 'main';

$script = array();

require_once 'include/control.php';
?>