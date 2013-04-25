<?php
require_once 'configu.php';
require_once 'include/functions.php';

$errorMessage = '&nbsp;';

if (isset($_POST['txtUserName']))
{
    $result = doLogin();
    
    if ($result != '')
        $errorMessage = $result;
    
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <title><?php echo AUTHORTTL; ?>Aгуулга удирдах систем</title>
    <link rel="shortcut icon" href="<?php echo CMS_ROOT;?>include/images/favico.ico"/>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charsetIso; ?>" />
    <link rel="stylesheet" href="<?php echo CMS_ROOT;?>include/css/login.css"/>
</head>
<body>
<form method="post" name="frmLogin" id="frmLogin">
    <div style="width: auto;" align="center">
        <div id="loginbox">
            <div id="usernamebox">
                <input class="thickfield" name="txtUserName" id="txtUserName" type="text" size="20" maxlength="49"/>
            </div>
            <div id="passwordbox">
                <input class="thickfield" id="txtPassword" name="txtPassword" type="password" maxlength="25"/>
            </div>
            <div id="errorbox">
                <?php echo $errorMessage; ?>
            </div>
            <input name="btnLogin" type="submit" id="loginbutton" value=""/> 
            <div id="copyrightbox">
                <a href="<?php echo AUTHORWEB; ?>" target="_blank"><?php echo AUTHORTXT; ?></a>
            </div>
        </div>
    </div>
</form>
</body>
</html>