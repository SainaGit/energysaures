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
        $pageTitle   = AUTHORTTL . 'Брэнд жагсаалт';
        $contentTitle   = 'Брэнд жагсаалт';
        break;

    case 'add' :
        $content     = 'add.php';        
        $pageTitle   = AUTHORTTL . 'Брэнд нэмэх';
        $contentTitle   = 'Брэнд нэмэх';
        break;

    case 'modify' :
        $content     = 'modify.php';        
        $pageTitle   = AUTHORTTL . 'Брэнд засах';
        $contentTitle   = 'Брэнд засах';
        break;

    default :
        $content     = 'list.php';        
        $pageTitle   = AUTHORTTL . 'Брэнд жагсаалт';
        $contentTitle   = 'Брэнд жагсаалт';
}

$script = array('brand.js');
$currentMenu = 'Brand';

require_once '../include/control.php';
?>
