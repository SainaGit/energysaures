<?php
require_once '../configu.php';
require_once '../include/functions.php';

$_SESSION['codesaur_login_return_url'] = $_SERVER['REQUEST_URI'];

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view)
{
    case 'list':
        $content     = 'list.php';        
        $pageTitle   = AUTHORTTL . 'Бараа бүтээгдхүүний жагсаалт';
        $contentTitle  = 'Бараа бүтээгдхүүний жагсаалт';
        break;

    case 'add':
        $content     = 'add.php';        
        $pageTitle   = AUTHORTTL . 'Бараа бүтээгдхүүн нэмэх';
        $contentTitle   = 'Бараа бүтээгдхүүн нэмэх';
        break;

    case 'modify':
        $content     = 'modify.php';        
        $pageTitle   = AUTHORTTL . 'Бараа бүтээгдхүүн засах';
        $contentTitle   = 'Бараа бүтээгдхүүн засах';
        break;

    default:
        $content     = 'list.php';        
        $pageTitle   = AUTHORTTL . 'Бараа бүтээгдхүүний жагсаалт';
        $contentTitle   = 'Бараа бүтээгдхүүний жагсаалт';
}

$script = array('product.js', 'comment.js');
$currentMenu = 'Product';

require_once '../include/control.php';
?>