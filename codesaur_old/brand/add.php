<?php
if (!defined('WEB_ROOT'))
    exit;

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?>
<script type="text/javascript" src="<?php echo HTML_EDITOR_PATH; ?>"></script>
<form action="execute.php?action=add" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
    <fieldset>
        <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
        <input id="txtType" name="txtType" type="hidden"/>
        <div id="divPicture1" class="input_field">
             <label for="txtPicture1">Лого</label>
             <input class="bigfield" name="txtPicture1" type="file" id="txtPicture1" />
        </div>
        <div id="divPicture2" class="input_field">
             <label for="txtPicture2">Зураг</label>
             <input class="bigfield" name="txtPicture2" type="file" id="txtPicture2" />
        </div>
        <div id="divName"  class="input_field">
             <label for="txtName">Нэр</label>
             <input class="bigfield" id="txtName" name="txtName" type="text" maxlength="199"/>
        </div>
        <div id="divShort_mn" class="input_field">
             <label for="txtShort_mn">Богино агуулга</label>
             <textarea class="textbox" cols="90" rows="3" id="txtShort_mn" name="txtShort_mn" style="width: 600px;"></textarea>
        </div>
        <div id="divShort_en" class="input_field">
             <label for="txtShort_en">Богино агуулга<br/> (англи)</label>
             <textarea class="textbox" cols="90" rows="3" id="txtShort_en" name="txtShort_en" style="width: 600px;"></textarea>
        </div>
        <div id="divFull_mn" class="input_field">
             <label for="txtFull_mn">Агуулга</label>
             <div style="height: 25px" ></div>
             <textarea cols="" rows=""  class="<?php echo HTML_EDITOR; ?>" name="txtFull_mn" id="txtFull_mn" ></textarea>
        </div>
        <div id="divFull_en" class="input_field">
             <label for="txtFull_en">Агуулга (англи)</label>
             <div style="height: 25px" ></div>
             <textarea cols="" rows=""  class="<?php echo HTML_EDITOR; ?>" name="txtFull_en" id="txtFull_en" ></textarea>
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