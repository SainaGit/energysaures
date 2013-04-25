<?php
defined('CODESAUR') || exit(1);

$errorMessage = '&nbsp;';

if (isset($_POST['txtUserName']))
{
    $result = codesaur::instance()->controller->doLogin();
    
    if ($result != '')
        $errorMessage = $result;
}
?>
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
            <input name="btnLogin" type="submit" id="loginbutton" value="" style="cursor:pointer;" />
            <div id="copyrightbox">
                <a href="<?php echo AUTHORWEB; ?>" target="_blank"><?php echo AUTHORTXT; ?></a>
            </div>
        </div>
    </div>
</form>