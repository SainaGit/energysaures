<?php
if (!defined('WEB_ROOT'))
    exit;

if (isset($_GET['id']) && (int)$_GET['id'] > 0)
    $modID = (int)$_GET['id'];
else 
    header('Location: index.php');

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql = "SELECT * FROM brand WHERE ID = $modID";
$result = dbQuery($sql);
if(dbNumRows($result) > 0)
{
    extract(dbFetchAssoc($result));
    
    $img1 = WEB_ROOT . NO_IMAGE;
    $img1Del = 0; 
    if($Image1 && $Image1 != "&")
    {
        $images1 = explode("&", stripslashes($Image1));
        $mainImg1 = $images1[0];
        $thumbImg1 = $images1[1];
        $img1 = WEB_ROOT . BRAND_IMAGES_DIR;
        $img1 = $img1 . $thumbImg1;
        $img1Del = 1;    
    }   
    
    $img2 = WEB_ROOT . NO_IMAGE;
    $img2Del = 0; 
    if($Image2 && $Image2 != "&")
    {
        $images2 = explode("&", stripslashes($Image2));
        $mainImg2 = $images2[0];
        $thumbImg2 = $images2[1];
        $img2 = WEB_ROOT . BRAND_IMAGES_DIR;
        $img2 = $img2 . $thumbImg2;
        $img2Del = 1;    
    }
?>
<script type="text/javascript" src="<?php echo HTML_EDITOR_PATH; ?>"></script>
<fieldset style="border: none; padding: 0;"> 
    <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
            <form action="execute.php?action=modify" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
                <input name="hidID" type="hidden" id="hidID" value="<?php echo $ID; ?>">
                <div id="divPicture1" class="input_field">
                     <label for="txtPicture1">Лого</label>
                     <input class="bigfield" name="txtPicture1" type="file" id="txtPicture1" />
                </div>
                <div id="divPictureChoose1" class="input_field">
                     <label for="txtPictureChoose1">Одоогийн лого</label>
                     <img style="float: left; display: block;" id="imgPictureChoose1" name="imgPictureChoose1" src="<?php echo $img1; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($img1Del) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'brand/execute.php?action=picture1&id=' . $ID; ?>"> лого устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divPicture2" class="input_field">
                     <label for="txtPicture2">Зураг</label>
                     <input class="bigfield" name="txtPicture2" type="file" id="txtPicture2" />
                </div>
                <div id="divPictureChoose2" class="input_field">
                     <label for="txtPictureChoose2">Одоогийн зураг</label>
                     <img style="float: left; display: block;" id="imgPictureChoose2" name="imgPictureChoose2" src="<?php echo $img2; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($img2Del) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'brand/execute.php?action=picture2&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divName"  class="input_field">
                     <label for="txtName">Нэр</label>
                     <input class="bigfield" id="txtName" name="txtName" type="text" maxlength="199" value="<?php echo stripslashes($Name);?>"/>
                </div>
                <div id="divShort_mn" class="input_field">
                     <label for="txtShort_mn">Богино агуулга</label>
                     <textarea class="textbox" cols="90" rows="3" id="txtShort_mn" name="txtShort_mn" style="width: 600px;"><?php echo stripslashes($Short_mn); ?></textarea>
                </div>
                <div id="divShort_en" class="input_field">
                     <label for="txtShort_en">Богино агуулга<br/> (англи)</label>
                     <textarea class="textbox" cols="90" rows="3" id="txtShort_en" name="txtShort_en" style="width: 600px;"><?php echo stripslashes($Short_en); ?></textarea>
                </div>
                <div id="divFull_mn" class="input_field">
                     <label for="txtFull_mn">Агуулга</label>
                     <div style="height: 25px" ></div>
                     <textarea cols="" rows=""  class="<?php echo HTML_EDITOR; ?>" name="txtFull_mn" id="txtFull_mn" ><?php echo stripslashes($Full_mn); ?></textarea>
                </div>
                <div id="divFull_en" class="input_field">
                     <label for="txtFull_en">Агуулга (англи)</label>
                     <div style="height: 25px" ></div>
                     <textarea cols="" rows=""  class="<?php echo HTML_EDITOR; ?>" name="txtFull_en" id="txtFull_en" ><?php echo stripslashes($Full_en); ?></textarea>
                </div>
                <div id="divRank"  class="input_field">
                     <label for="txtRank">Дараалал</label>
                     <input class="smallfield" id="txtRank" name="txtRank" type="text" maxlength="3" onKeyUp="checkNumber(this);" value="<?php echo stripslashes($Rank); ?>"/>
                     <span class="spanRank">бичлэг сайт дээр харагдах дараалал</span>
                </div>
                <div id="divIsActive"  class="input_field">
                     <label for="txtIsActive">Статус</label>
                     <select class="mediumfield" id="txtIsActive" name="txtIsActive">
                        <option value="1" <?php if(stripslashes($IsActive) == 1) echo 'selected="selected"'; ?>>Идэвхитэй</option>
                        <option value="0" <?php if(stripslashes($IsActive) == 0) echo 'selected="selected"'; ?>>Идэвхигүй</option>                
                     </select>
                     <span class="spanIsActive">идэвхитэй бичлэг сайт дээр харагдана</span>
                </div>
                <br/>
                <?php if($errorMessage != '&nbsp;'){ ?>
                <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessage; ?></p></div>
                <?php } ?>
                <input class="submit" type="button" id="btnModify" name="btnModify" value="Хадгалах" onClick="checkModifyForm();">
                <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php';"> 
            </form>
</fieldset>
<?php
}
else 
    header('Location: index.php');    
?>
