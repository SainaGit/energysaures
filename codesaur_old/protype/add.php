<?php
if (!defined('WEB_ROOT'))
    exit;

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?>
<form action="execute.php?action=add" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
    <fieldset>
        <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
        <input id="txtType" name="txtType" type="hidden"/>
        <div id="divPicture_mn" class="input_field">
             <label for="txtPicture_mn">Зураг</label>
             <input class="bigfield" name="txtPicture_mn" type="file" id="txtPicture_mn" />
        </div>
        <div id="divPicture_en" class="input_field">
             <label for="txtPicture_en">Зураг (англи)</label>
             <input class="bigfield" name="txtPicture_en" type="file" id="txtPicture_en" />
        </div>
        <div id="divName_mn"  class="input_field">
             <label for="txtName_mn">Нэр</label>
             <input class="bigfield" id="txtName_mn" name="txtName_mn" type="text" maxlength="199"/>
        </div>
        <div id="divName_en"  class="input_field">
             <label for="txtName_en">Нэр (англи)</label>
             <input class="bigfield" id="txtName_en" name="txtName_en" type="text" maxlength="199"/>
        </div>        
        <div id="divRank"  class="input_field">
             <label for="txtRank">Дараалал</label>
             <input class="smallfield" id="txtRank" name="txtRank" type="text" maxlength="3" onKeyUp="checkNumber(this);" value="10"/>
             <span class="spanRank">бичлэг сайт дээр харагдах дараалал</span>
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
        <?php if($errorMessage != '&nbsp;'){ ?>
        <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessage; ?></p></div>
        <?php } ?>
        <input class="submit" type="button" id="btnAdd" name="btnAdd" value="Хадгалах" onClick="checkAddForm();">
        <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php';"> 
    </fieldset>
</form>