<?php
if (!defined('WEB_ROOT'))
    exit;

if (isset($_GET['id']) && (int)$_GET['id'] > 0)
    $modID = (int)$_GET['id'];
else 
    header('Location: index.php');

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql = "SELECT * FROM maintype WHERE ID = $modID";
$result = dbQuery($sql);
if(dbNumRows($result) > 0)
{
    extract(dbFetchAssoc($result));
    
    $img_mn = WEB_ROOT . NO_IMAGE;
    $imgDel_mn = 0; 
    if($Image_mn && $Image_mn != "&")
    {
        $images_mn = explode("&", stripslashes($Image_mn));
        $mainImg_mn = $images_mn[0];
        $thumbImg_mn = $images_mn[1];
        $img_mn = WEB_ROOT . MAINTYPE_IMAGES_DIR . $thumbImg_mn;
        $imgDel_mn = 1;    
    }   
    
    $img_en = WEB_ROOT . NO_IMAGE;
    $imgDel_en = 0; 
    if($Image_en && $Image_en != "&")
    {
        $images_en = explode("&", stripslashes($Image_en));
        $mainImg_en = $images_en[0];
        $thumbImg_en = $images_en[1];
        $img_en = WEB_ROOT . MAINTYPE_IMAGES_DIR . $thumbImg_en;
        $imgDel_en = 1;    
    }
?>
<fieldset style="border: none; padding: 0;"> 
    <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
            <form action="execute.php?action=modify" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
                <input name="hidID" type="hidden" id="hidID" value="<?php echo $ID; ?>">
                <div id="divPicture_mn" class="input_field">
                     <label for="txtPicture_mn">Зураг</label>
                     <input class="bigfield" name="txtPicture_mn" type="file" id="txtPicture_mn" />
                </div>
                <div id="divPictureChoose_mn" class="input_field">
                     <label for="txtPictureChoose_mn">Одоогийн зураг</label>
                     <img style="float: left; display: block;" id="imgPictureChoose_mn" name="imgPictureChoose_mn" src="<?php echo $img_mn; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($imgDel_mn) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'maintype/execute.php?action=picture_mn&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divPicture_en" class="input_field">
                     <label for="txtPicture_en">Зураг (англи)</label>
                     <input class="bigfield" name="txtPicture_en" type="file" id="txtPicture_en" />
                </div>
                <div id="divPictureChoose_en" class="input_field">
                     <label for="txtPictureChoose_en">Одоогийн зураг<br/> (англи)</label>
                     <img style="float: left; display: block;" id="imgPictureChoose_en" name="imgPictureChoose_en" src="<?php echo $img_en; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($imgDel_en) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'maintype/execute.php?action=picture_en&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divName_mn"  class="input_field">
                     <label for="txtName_mn">Нэр</label>
                     <input class="bigfield" id="txtName_mn" name="txtName_mn" type="text" maxlength="199" value="<?php echo stripslashes($Name_mn);?>"/>
                </div>
                <div id="divName_en"  class="input_field">
                     <label for="txtName_en">Нэр (англи)</label>
                     <input class="bigfield" id="txtName_en" name="txtName_en" type="text" maxlength="199" value="<?php echo stripslashes($Name_en);?>"/>
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
