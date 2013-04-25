<?php
if (!defined('WEB_ROOT'))
    exit;

if (isset($_GET['id']) && (int)$_GET['id'] > 0)
    $modID = (int)$_GET['id'];
else
    header('Location: index.php');

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql = "SELECT * FROM admin WHERE ID = $modID";
$result = dbQuery($sql);
if(dbNumRows($result)>0)
{
    extract(dbFetchAssoc($result))
?>
<form action="execute.php?action=modify" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
    <fieldset>
        <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
        <input name="hidID" type="hidden" id="hidID" value="<?php echo $ID; ?>">
        <div id="divUserName"  class="input_field">
             <label for="txtUserName">Нэвтрэх нэр</label>
             <input class="mediumfield" id="txtUserName" name="txtUserName" type="text" maxlength="49" value="<?php echo stripslashes($UserName); ?>"/>
        </div>
        <div id="divPassword"  class="input_field">
             <label for="txtPassword">Нууц үг</label>
             <input class="mediumfield" id="txtPassword" name="txtPassword" type="password" maxlength="20"/>
        </div>
        <div id="divFirstName"  class="input_field">
             <label for="txtFirstName">Нэр</label>
             <input class="mediumfield" id="txtFirstName" name="txtFirstName" type="text" maxlength="199" value="<?php echo stripslashes($FirstName); ?>"/>
        </div>
        <div id="divLastName"  class="input_field">
             <label for="txtLastName">Овог</label>
             <input class="mediumfield" id="txtLastName" name="txtLastName" type="text" maxlength="199" value="<?php echo stripslashes($LastName); ?>"/>
        </div>
        <div id="divEmail"  class="input_field">
             <label for="txtEmail">Имайл</label>
             <input class="mediumfield" id="txtEmail" name="txtEmail" type="text" maxlength="199" value="<?php echo stripslashes($Email); ?>"/>
             <span class="spanEmail">email@domain.com</span>
        </div>
        <div id="divIsActive"  class="input_field">
             <label for="divIsActive">Статус</label>
             <select class="mediumfield" id="txtIsActive" name="txtIsActive">
                <option value="1" <?php if(stripslashes($IsActive) == 1) echo 'selected="selected"'; ?> >Идэвхитэй</option>
                <option value="0" <?php if(stripslashes($IsActive) == 0) echo 'selected="selected"'; ?> >Идэвхигүй</option>
             </select>
             <span class="spanIsActive">идэвхитэй хэрэглэгч сайт руу нэвтэрч чадна</span>
        </div>
        <?php if($errorMessage != '&nbsp;') { ?>
        <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessage; ?></p></div>
        <?php } ?>
        <input class="submit" type="button" id="btnModify" name="btnModify" value="Хадгалах" onClick="checkModifyForm();">
        <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php';"> 
    </fieldset>
</form>
<?php
}
else
    header('Location: index.php');    
?>
