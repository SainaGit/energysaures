<?php
require_once '../configu.php';
require_once '../include/functions.php';

$_SESSION['codesaur_login_return_url'] = $_SERVER['REQUEST_URI'];

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view)
{
    case 'list' :
        $content     = 'list.php';        
        $pageTitle   = AUTHORTTL . 'Баннер жагсаалт';
        $contentTitle   = 'Баннер жагсаалт';
        break;
    
    case 'add' :
        $content     = 'add.php';        
        $pageTitle   = AUTHORTTL . 'Баннер нэмэх';
        $contentTitle   = 'Баннер нэмэх';
        break;

    case 'modify' :
        $content     = 'modify.php';        
        $pageTitle   = AUTHORTTL . 'Баннер засах';
        $contentTitle   = 'Баннер засах';
        break;

    default :
        $content     = 'list.php';        
        $pageTitle   = AUTHORTTL . 'Баннер жагсаалт';
        $contentTitle   = 'Баннер жагсаалт';
}

$script = array('banner.js');
$currentMenu = 'Banner';

require_once '../include/control.php';
?>