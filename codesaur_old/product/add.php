<?php
if (!defined('WEB_ROOT'))
    exit;

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?>
<script type="text/javascript" src="<?php echo HTML_EDITOR_PATH; ?>"></script>
<form action="execute.php?action=add" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
    <fieldset>
        <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
        <div id="divBrandID"  class="input_field">
            <label for="txtBrandID">Брэнд</label>
            <select class="mediumfield" id="txtBrandID" name="txtBrandID">
                <option value="<?php echo UNKNOWN_ID; ?>"><?php echo UNKNOWN_MN; ?></option>
                <?php
                $sqlBrand = "SELECT * FROM brand ORDER BY Rank, DateCreated DESC";
                $resultBrand = dbQuery($sqlBrand);
                $countBrand = dbNumRows($resultBrand); 
                if($countBrand > 0)
                {
                    while($rowBrand = dbFetchAssoc($resultBrand))
                    {
                        extract($rowBrand);
                        echo '<option value="'.$rowBrand['ID'].'">'.$rowBrand['Name'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div id="divMainType"  class="input_field">
            <label for="txtMainType">Ерөнхий төрөл</label>
            <select class="mediumfield" id="txtMainType" name="txtMainType">
                <?php
                $sqlMainType = "SELECT * FROM maintype ORDER BY Rank, DateCreated DESC";
                $resultMainType = dbQuery($sqlMainType);
                $countMainType = dbNumRows($resultMainType); 
                if($countMainType > 0)
                {
                    while($rowMainType = dbFetchAssoc($resultMainType))
                    {
                        echo '<option value="'.$rowMainType['ID'].'">'.$rowMainType['Name_mn'].'</option>';
                    }
                }
                ?>              
            </select>
        </div>
        <div id="divMainType2"  class="input_field">
            <label for="txtMainType2">Ерөнхий төрөл 2</label>
            <select class="mediumfield" id="txtMainType2" name="txtMainType2">
                <?php
                echo '<option value="'.UNKNOWN_ID.'">'.UNKNOWN_MN.'</option>';
                $sqlMainType = "SELECT * FROM maintype ORDER BY Rank, DateCreated DESC";
                $resultMainType = dbQuery($sqlMainType);
                $countMainType = dbNumRows($resultMainType); 
                if($countMainType > 0)
                {
                    while($rowMainType = dbFetchAssoc($resultMainType))
                    {
                        echo '<option value="'.$rowMainType['ID'].'">'.$rowMainType['Name_mn'].'</option>';
                    }
                }
                ?>              
            </select>
        </div>
        <div id="divMainType3"  class="input_field">
            <label for="txtMainType3">Ерөнхий төрөл 3</label>
            <select class="mediumfield" id="txtMainType3" name="txtMainType3">
                <?php
                echo '<option value="'.UNKNOWN_ID.'">'.UNKNOWN_MN.'</option>';
                $sqlMainType = "SELECT * FROM maintype ORDER BY Rank, DateCreated DESC";
                $resultMainType = dbQuery($sqlMainType);
                $countMainType = dbNumRows($resultMainType); 
                if($countMainType > 0)
                {
                    while($rowMainType = dbFetchAssoc($resultMainType))
                    {
                        echo '<option value="'.$rowMainType['ID'].'">'.$rowMainType['Name_mn'].'</option>';
                    }
                }
                ?>              
            </select>
        </div>
        <div id="divProType"  class="input_field">
            <label for="txtProType">Нарийвчилсан төрөл</label>
            <select class="mediumfield" id="txtProType" name="txtProType">
                <?php
                $sqlProType = "SELECT * FROM protype ORDER BY Rank, DateCreated DESC";
                $resultProType = dbQuery($sqlProType);
                $countProType = dbNumRows($resultProType); 
                if($countProType > 0)
                {
                    while($rowProType = dbFetchAssoc($resultProType))
                    {
                        echo '<option value="'.$rowProType['ID'].'">'.$rowProType['Name_mn'].'</option>';
                    }
                }
                ?>              
            </select>
        </div>
        <div id="divPicture1" class="input_field">
             <label for="txtPicture1">Зураг 1</label>
             <input class="bigfield" name="txtPicture1" type="file" id="txtPicture1" />
        </div>
        <div id="divPicture2" class="input_field">
             <label for="txtPicture2">Зураг 2</label>
             <input class="bigfield" name="txtPicture2" type="file" id="txtPicture2" />
        </div>
        <div id="divPicture3" class="input_field">
             <label for="txtPicture3">Зураг 3</label>
             <input class="bigfield" name="txtPicture3" type="file" id="txtPicture3" />
        </div>
        <div id="divName_mn"  class="input_field">
             <label for="txtName_mn">Нэр</label>
             <input class="bigfield" id="txtName_mn" name="txtName_mn" type="text" maxlength="199"/>
        </div>
        <div id="divName_en"  class="input_field">
             <label for="txtName_en">Нэр (англи)</label>
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
                <option value="1" selected="selected">Бичигдсэн сэтгэгдлүүдийг зочдод харуулна.</option>
                <option value="0">Бичигдсэн сэтгэгдлүүдийг зочдод харуулахгүй.</option>                
             </select>
        </div>
        <div id="diCanComment"  class="input_field">
             <label for="txtCanComment">&nbsp;</label>
             <select class="bigfield" id="txtCanComment" name="txtCanComment">
                <option value="1" selected="selected">Зочид сэтгэгдэл үлдээж(бичиж) болно.</option>
                <option value="0">Зочид сэтгэгдэл үлдээж(бичиж) болохгүй.</option>                
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