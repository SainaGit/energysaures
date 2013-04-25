<?php
if (!defined('WEB_ROOT'))
    exit;

if (isset($_GET['id']) && (int)$_GET['id'] > 0)
    $modID = (int)$_GET['id'];
else
    header('Location: index.php');

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql = "SELECT * FROM banner WHERE ID = $modID";
$result = dbQuery($sql);
if(dbNumRows($result) > 0)
{
    extract(dbFetchAssoc($result));
    
    $img = WEB_ROOT . NO_IMAGE;
    $imgDel = 0; 
    if($Image && $Image != "&")
    {
        $images = explode("&", stripslashes($Image));
        $mainImg = $images[0];
        $thumbImg = $images[1];
        $img = WEB_ROOT . BANNER_IMAGES_DIR . $thumbImg;
        $imgDel = 1;    
    }   
?>
<fieldset style="border: none; padding: 0;"> 
    <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
            <form action="execute.php?action=modify" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
                <input name="hidID" type="hidden" id="hidID" value="<?php echo $ID; ?>">
                <div id="divPicture" class="input_field">
                     <label for="txtPicture">Зураг</label>
                     <input class="bigfield" name="txtPicture" type="file" id="txtPicture" />
                </div>
                <div id="divPictureChoose" class="input_field">
                     <label for="txtPictureChoose">Одоогийн зураг</label>
                     <img style="float: left; display: block;" id="imgPictureChoose" name="imgPictureChoose" src="<?php echo $img; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($imgDel) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'banner/execute.php?action=picture&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divName"  class="input_field">
                     <label for="txtName">Гарчиг</label>
                     <input class="bigfield" id="txtName" name="txtName" type="text" maxlength="199" value="<?php echo stripslashes($Name);?>"/>
                </div>
                <div id="divLink" class="input_field">
                     <label for="txtLink">Link</label>
                     <input class="bigfield" id="txtLink" name="txtLink" type="text" maxlength="199" value="<?php echo stripslashes($Link);?>"/>
                </div>
                <div id="divIsActive"  class="input_field">
                     <label for="txtIsActive">Статус</label>
                     <select class="mediumfield" id="txtIsActive" name="txtIsActive">
                        <option value="1" <?php if(stripslashes($IsActive) == 1) echo 'selected="selected"'; ?> >Идэвхитэй</option>
                        <option value="0" <?php if(stripslashes($IsActive) == 0) echo 'selected="selected"'; ?> >Идэвхигүй</option>                
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
