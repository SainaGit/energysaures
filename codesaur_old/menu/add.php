<?php
if (!defined('WEB_ROOT'))
    exit;

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?>
<script type="text/javascript" src="<?php echo HTML_EDITOR_PATH; ?>"></script>
<form action="execute.php?action=add" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
    <fieldset>
        <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
        <div id="divParentID"  class="input_field">
             <label for="txtParentID">Топ меню</label>
             <select class="bigfield" id="txtParentID" name="txtParentID">
                <option value="0">--Үндсэн меню--</option>
                <?php
                $sql = "SELECT * FROM menu ORDER BY ParentID, Rank";
                $result = dbQuery($sql);
                if(dbNumRows($result) > 0){
                    while($row = dbFetchAssoc($result)){
                        echo '<option value="'.$row['ID'].'">'.showPath(GetMenu($row['ID'])).'</option>';
                    }
                } 
                ?>               
             </select>
        </div>
        <div id="divType"  class="input_field">
            <label for="txtType">Төрөл</label>
            <select class="mediumfield" id="txtType" name="txtType">
                <?php
                foreach($menuType as $key => $value){
                    if ($key == DEFAULT_MENU_KEY)
                        echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                    else
                        echo '<option value="'.$key.'">'.$value.'</option>';
                }  
                ?>               
            </select>
        </div>
        <div id="divPicture_mn" class="input_field">
             <label for="txtPicture_mn">Зураг</label>
             <input class="bigfield" name="txtPicture_mn" type="file" id="txtPicture_mn" />
        </div>
        <div id="divPicture_en" class="input_field">
             <label for="txtPicture_en">Зураг (англи)</label>
             <input class="bigfield" name="txtPicture_en" type="file" id="txtPicture_en" />
        </div>
        <div id="divName_mn"  class="input_field">
             <label for="txtName_mn">Меню</label>
             <input class="bigfield" id="txtName_mn" name="txtName_mn" type="text" maxlength="199"/>
        </div>
        <div id="divName_en"  class="input_field">
             <label for="txtName_en">Меню (англи)</label>
             <input class="bigfield" id="txtName_en" name="txtName_en" type="text" maxlength="199"/>
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
        <div id="divIsActive_mn"  class="input_field">
             <label for="txtIsActive_mn">Статус</label>
             <select class="mediumfield" id="txtIsActive_mn" name="txtIsActive_mn">
                <option value="1">Идэвхитэй</option>
                <option value="0">Идэвхигүй</option>                
             </select>
             <span class="spanIsActive_mn">идэвхитэй бичлэг сайт дээр харагдана</span>
        </div>
        <div id="divIsActive_en"  class="input_field">
             <label for="txtIsActive_en">Статус (англи)</label>
             <select class="mediumfield" id="txtIsActive_en" name="txtIsActive_en">
                <option value="1">Идэвхитэй</option>
                <option value="0">Идэвхигүй</option>                
             </select>
             <span class="spanIsActive_en">идэвхитэй бичлэг сайт дээр харагдана</span>
        </div>
        <div id="divShowComment"  class="input_field">
             <label for="txtShowComment">Сэтгэгдэл<br/>(comment)</label>
             <select class="bigfield" id="txtShowComment" name="txtShowComment">
                <option value="1">Бичигдсэн сэтгэгдлүүдийг зочдод харуулна.</option>
                <option value="0" selected="selected">Бичигдсэн сэтгэгдлүүдийг зочдод харуулахгүй.</option>                
             </select>
        </div>
        <div id="diCanComment"  class="input_field">
             <label for="txtCanComment">&nbsp;</label>
             <select class="bigfield" id="txtCanComment" name="txtCanComment">
                <option value="1">Зочид сэтгэгдэл үлдээж(бичиж) болно.</option>
                <option value="0" selected="selected">Зочид сэтгэгдэл үлдээж(бичиж) болохгүй.</option>                
             </select>
        </div>
        <br/>        
        <?php if($errorMessage != '&nbsp;'){ ?>
        <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessage; ?></p></div>
        <?php } ?>
        <input class="submit" type="button" id="btnAdd" name="btnAdd" value="Хадгалах" onClick="checkAddForm();">
        <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php';"> 
    </fieldset>
</form>