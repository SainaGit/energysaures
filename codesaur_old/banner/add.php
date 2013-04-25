<?php
if (!defined('WEB_ROOT'))
    exit;

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?>
<form action="execute.php?action=add" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
    <fieldset>
        <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
        <input id="txtType" name="txtType" type="hidden"/>
        <div id="divPicture" class="input_field">
             <label for="txtPicture">Зураг</label>
             <input class="bigfield" name="txtPicture" type="file" id="txtPicture" />
        </div>
        <div id="divName"  class="input_field">
             <label for="txtName">Гарчиг</label>
             <input class="bigfield" id="txtName" name="txtName" type="text" maxlength="199"/>
        </div>
        <div id="divLink" class="input_field">
             <label for="txtLink">Link</label>
             <input class="bigfield" id="txtLink" name="txtLink" type="text" maxlength="199" />
        </div>
        <div id="divIsActive"  class="input_field">
             <label for="txtIsActive">Статус</label>
             <select class="mediumfield" id="txtIsActive" name="txtIsActive">
                <option value="1">Идэвхитэй</option>
                <option value="0">Идэвхигүй</option>                
             </select>
             <span class="spanIsActive">идэвхитэй бичлэг сайт дээр харагдана</span>
        </div>
        <br/>
        <?php if($errorMessage != '&nbsp;') { ?>
        <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessage; ?></p></div>
        <?php } ?>
        <input class="submit" type="button" id="btnAdd" name="btnAdd" value="Хадгалах" onClick="checkAddForm();">
        <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php';"> 
    </fieldset>
</form>