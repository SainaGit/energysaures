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
        $pageTitle   = AUTHORTTL . 'Хуудас жагсаалт';
        $contentTitle  = 'Хуудас жагсаалт';
        break;

    case 'add' :
        $content     = 'add.php';        
        $pageTitle   = AUTHORTTL . 'Хуудас нэмэх';
        $contentTitle   = 'Хуудас нэмэх';
        break;

    case 'modify' :
        $content     = 'modify.php';        
        $pageTitle   = AUTHORTTL . 'Хуудас засах';
        $contentTitle   = 'Хуудас засах';
        break;

    default :
        $content     = 'list.php';        
        $pageTitle   = AUTHORTTL . 'Хуудас жагсаалт';
        $contentTitle   = 'Хуудас жагсаалт';
}

$script = array('menu.js', 'comment.js');
$currentMenu = 'Menu';

require_once '../include/control.php';
?>