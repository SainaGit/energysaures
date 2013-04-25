<?php
require_once 'configu.php';

setlocale(LC_TIME, 'en_EN');

define('AUTHORTTL', 'Кодезавр - ');
define('AUTHORWEB', 'http://www.coden.mn');
define('AUTHORTXT', 'Кодезавр агуулга удирдах систем нь “Мөнхийн-Ололт” ХХК-ны бүтээл &copy ' . date('Y') . '.');
define('AUTHORINF', 'coden aka NarankhuuN, naregmailbox@yahoo.com, +976 99105835');

$thisFile   = str_replace('\\', '/', __FILE__);
$srvRoot    = str_replace($cmsDir. 'default.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);
define('CMS_ROOT', $webRoot . $cmsDir);

if (!get_magic_quotes_gpc())
{
    if (isset($_POST))
    {
        if(is_array($_POST))
        {
            foreach ($_POST as $key => $value)
            {
                $_POST[$key] = $value;
            }
        }
        else
        {
            foreach ($_POST as $key => $value)
            {
                $_POST[$key] =  trim(addslashes($value));
            }
        }
    }
    
    if (isset($_GET)) 
    {
        foreach ($_GET as $key => $value)
        {
            $_GET[$key] = trim(addslashes($value));
        }
    }    
}
?>