<?php
require_once '../configu.php';
require_once '../include/functions.php';

$_SESSION['codesaur_login_return_url'] = $_SERVER['REQUEST_URI'];

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

$contentTitle   = 'Ерөнхий төрлүүд';

switch ($view)
{
    case 'add' :
        $content     = 'add.php';        
        $contentTitle   = 'Ерөнхий төрөл нэмэх';
        break;

    case 'modify' :
        $content     = 'modify.php';        
        $contentTitle   = 'Ерөнхий төрөл засах';
        break;

    default :
        $content     = 'list.php';        
}

$pageTitle   = AUTHORTTL . $contentTitle;

$script = array('maintype.js');
$currentMenu = 'MainType';

require_once '../include/control.php';
?>
