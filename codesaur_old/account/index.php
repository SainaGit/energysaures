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
        $pageTitle   = AUTHORTTL . 'Админ жагсаалт';
        $contentTitle   = 'Админ жагсаалт';
        break;

    case 'add' :
        $content     = 'add.php';        
        $pageTitle   = AUTHORTTL . 'Админ нэмэх';
        $contentTitle   = 'Админ нэмэх';
        break;

    case 'modify' :
        $content     = 'modify.php';        
        $pageTitle   = AUTHORTTL . 'Админ засах';
        $contentTitle   = 'Админ засах';
        break;

    default :
        $content     = 'list.php';        
        $pageTitle   = AUTHORTTL . 'Админ жагсаалт';
        $contentTitle   = 'Админ жагсаалт';
}

$script = array('account.js');
$currentMenu = 'Admin';

require_once '../include/control.php';
?>