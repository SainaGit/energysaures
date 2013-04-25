<?php
if (!defined('WEB_ROOT'))
    exit;

if (isset($_GET['id']) && (int)$_GET['id'] > 0)
    $modID = (int)$_GET['id'];
else
    header('Location: index.php');

$comment = (isset($_GET['comment']) && $_GET['comment'] != '') ? $_GET['comment'] : '0';  

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$errorMessageComment = (isset($_GET['errorComment']) && $_GET['errorComment'] != '') ? $_GET['errorComment'] : '&nbsp;';
$successMessageComment = (isset($_GET['successComment']) && $_GET['successComment'] != '') ? $_GET['successComment'] : '&nbsp;'; 

$sql = "SELECT * FROM menu WHERE ID = $modID";
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
        $img_mn = WEB_ROOT . MENU_IMAGES_DIR;
        $img_mn = $img_mn . $thumbImg_mn;
        $imgDel_mn = 1;    
    }   
    
    $img_en = WEB_ROOT . NO_IMAGE;
    $imgDel_en = 0; 
    if($Image_en && $Image_en != "&")
    {
        $images_en = explode("&", stripslashes($Image_en));
        $mainImg_en = $images_en[0];
        $thumbImg_en = $images_en[1];
        $img_en = WEB_ROOT . MENU_IMAGES_DIR;
        $img_en = $img_en . $thumbImg_en;
        $imgDel_en = 1;    
    }
?>
<script type="text/javascript" src="<?php echo HTML_EDITOR_PATH; ?>"></script>
<script type="text/javascript">
$(function()
{
    $( "#tabs" ).tabs();
});
</script>
<fieldset style="border: none; padding: 0;"> 
    <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Мэдээ</a></li>
            <li><a href="#tabs-2">Сэтгэгдэл</a></li> 
        </ul>
        <div id="tabs-1">        
            <form action="execute.php?action=modify" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
                <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
                <input name="hidID" type="hidden" id="hidID" value="<?php echo $ID; ?>">
                <div id="divParentID"  class="input_field">
                    <label for="txtParentID">Топ Меню</label>
                    <select class="bigfield" id="txtParentID" name="txtParentID">
                    <option value="0">--Үндсэн Меню--</option>
                    <?php
                    $sql = "SELECT * FROM menu WHERE ID != $modID ORDER BY ParentID, Rank";
                    $result = dbQuery($sql);
                    if(dbNumRows($result) > 0)
                    {
                        while($row = dbFetchAssoc($result))
                        {
                            if($row['ID'] == $ParentID)
                                echo '<option selected="selected" value="'.$row['ID'].'">'.showPath(GetMenu($row['ID'])).'</option>';    
                            else
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
                    foreach($menuType as $key => $value)
                    {
                        if($key==$Type)
                            echo '<option selected="selected" value="'.$key.'">'.$value.'</option>';    
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
                <div id="divPictureChoose_mn" class="input_field">
                     <label for="txtPictureChoose_mn">Одоогийн Зураг</label>
                     <img style="float: left; display: block;" id="imgPictureChoose_mn" name="imgPictureChoose_mn" src="<?php echo $img_mn; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($imgDel_mn) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'menu/execute.php?action=picture_mn&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divPicture_en" class="input_field">
                     <label for="txtPicture_en">Зураг (Англи)</label>
                     <input class="bigfield" name="txtPicture_en" type="file" id="txtPicture_en" />
                </div>
                <div id="divPictureChoose_en" class="input_field">
                     <label for="txtPictureChoose_en">Одоогийн Зураг<br/> (Англи)</label>
                     <img style="float: left; display: block;" id="imgPictureChoose_en" name="imgPictureChoose_en" src="<?php echo $img_en; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($imgDel_en) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'menu/execute.php?action=picture_en&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divName_mn"  class="input_field">
                    <label for="txtName_mn">Меню</label>
                    <input class="bigfield" id="txtName_mn" name="txtName_mn" type="text" maxlength="199" value="<?php echo stripslashes($Name_mn);?>"/>
                </div>
                <div id="divName_en"  class="input_field">
                    <label for="txtName_en">Меню (Англи)</label>
                    <input class="bigfield" id="txtName_en" name="txtName_en" type="text" maxlength="199" value="<?php echo stripslashes($Name_en);?>"/>
                </div>
                <div id="divShort_mn" class="input_field">
                    <label for="txtShort_mn">Богино Агуулга</label>
                    <textarea class="textbox" cols="90" rows="3" id="txtShort_mn" name="txtShort_mn" style="width: 600px;"><?php echo stripslashes($Short_mn); ?></textarea>
                </div>
                <div id="divShort_en" class="input_field">
                    <label for="txtShort_en">Богино Агуулга<br/> (Англи)</label>
                    <textarea class="textbox" cols="90" rows="3" id="txtShort_en" name="txtShort_en" style="width: 600px;"><?php echo stripslashes($Short_en); ?></textarea>
                </div>
                <div id="divFull_mn" class="input_field">
                    <label for="txtFull_mn">Агуулга</label>
                    <div style="height: 25px" ></div>
                    <textarea cols="" rows="" class="<?php echo HTML_EDITOR; ?>" name="txtFull_mn" id="txtFull_mn" ><?php echo stripslashes($Full_mn); ?></textarea>
                </div>
                <div id="divFull_en" class="input_field">
                    <label for="txtFull_en">Агуулга (Англи)</label>
                    <div style="height: 25px" ></div>
                    <textarea cols="" rows=""  class="<?php echo HTML_EDITOR; ?>" name="txtFull_en" id="txtFull_en" ><?php echo stripslashes($Full_en); ?></textarea>
                </div>
                <div id="divRank"  class="input_field">
                    <label for="txtRank">Дараалал</label>
                    <input class="smallfield" id="txtRank" name="txtRank" type="text" maxlength="3" onKeyUp="checkNumber(this);" value="<?php echo stripslashes($Rank); ?>"/>
                    <span class="spanRank">бичлэг сайт дээр харагдах дараалал</span>
                </div>
                <div id="divIsActive_mn"  class="input_field">
                    <label for="txtIsActive_mn">Статус</label>
                    <select class="mediumfield" id="txtIsActive_mn" name="txtIsActive_mn">
                        <option value="1" <?php if($IsActive_mn == 1) echo 'selected="selected"'; ?> >Идэвхитэй</option>
                        <option value="0" <?php if($IsActive_mn == 0) echo 'selected="selected"'; ?> >Идэвхигүй</option>                
                    </select>
                    <span class="spanIsActive_mn">идэвхитэй бичлэг сайт дээр харагдана</span>
                </div>
                <div id="divIsActive_en"  class="input_field">
                    <label for="txtIsActive_en">Статус (Англи)</label>
                    <select class="mediumfield" id="txtIsActive_en" name="txtIsActive_en">
                        <option value="1" <?php if($IsActive_en == 1) echo 'selected="selected"'; ?> >Идэвхитэй</option>
                        <option value="0" <?php if($IsActive_en == 0) echo 'selected="selected"'; ?> >Идэвхигүй</option>                
                    </select>
                    <span class="spanIsActive_en">идэвхитэй бичлэг сайт дээр харагдана</span>
                </div>
                <div id="divShowComment"  class="input_field">
                    <label for="txtShowComment">Сэтгэгдэл<br/>(comment)</label>
                    <select class="bigfield" id="txtShowComment" name="txtShowComment">
                        <option value="1" <?php if(stripslashes($ShowComment) == 1) echo 'selected="selected"'; ?>>Бичигдсэн сэтгэгдлүүдийг зочдод харуулна.</option>
                        <option value="0" <?php if(stripslashes($ShowComment) == 0) echo 'selected="selected"'; ?>>Бичигдсэн сэтгэгдлүүдийг зочдод харуулахгүй.</option>                
                    </select>
                </div>
                <div id="divCanComment"  class="input_field">
                    <label for="txtCanComment">&nbsp;</label>
                    <select class="bigfield" id="txtCanComment" name="txtCanComment">
                        <option value="1" <?php if(stripslashes($CanComment) == 1) echo 'selected="selected"'; ?>>Зочид сэтгэгдэл үлдээж(бичиж) болно.</option>
                        <option value="0" <?php if(stripslashes($CanComment) == 0) echo 'selected="selected"'; ?>>Зочид сэтгэгдэл үлдээж(бичиж) болохгүй.</option>                
                    </select>
                </div>
                <br/>        
                <?php if($errorMessage != '&nbsp;'){ ?>
                <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessage; ?></p></div>
                <?php } ?>
                <input class="submit" type="button" id="btnModify" name="btnModify" value="Хадгалах" onClick="checkModifyForm();">
                <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php';"> 
            </form>
        </div>
        <div id="tabs-2">
            <?php
            $sqlComment = "SELECT * FROM menu_comment WHERE ReferenceID = $modID ORDER BY DateCreated DESC";
            $resultComment = dbQuery($sqlComment);
            ?>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Нэр</th> 
                        <th>Сэтгэгдэл</th>
                        <th>Огноо</th>
                        <th>Статус</th>
                        <th>Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(dbNumRows($resultComment)>0)
                {
                    $i = 0;
                    while($rowComment = dbFetchAssoc($resultComment))
                    {
                        $i += 1;
                ?>
                    <tr <?php if($i%2 == 0) { echo 'class="alt"'; }?> >
                        <td><?php echo $rowComment['Name']; ?></td>   
                        <td><?php echo $rowComment['Short']; ?></td> 
                        <td><?php echo $rowComment['DateCreated']; ?></td> 
                        <td><?php echo isActive($rowComment['IsActive']); ?></td> 
                        <td>
                            <a class="edit" href="javascript:modComment(<?php echo $rowComment['ID']; ?>, <?php echo $modID; ?>);"><?php echo $btnEditCaption; ?></a>
                            <a class="delete" href="javascript:delComment(<?php echo $rowComment['ID']; ?>, <?php echo $modID; ?>);"><?php echo $btnDeleteCaption; ?></a>
                        </td>
                    </tr>
                <?php
                    }
                }
                else{
                ?>
                    <tr>
                        <td colspan="5">Сэтгэгдэл бүртгэгдээгүй байна.</td>
                    </tr>
                <?php
                }
                ?>
                </tbody>    
            </table>
            <br/>
            <?php
            if($comment == 0)
            {
            ?>
            <form action="execute.php?action=addComment" method="post" enctype="multipart/form-data" name="frmComment" id="frmComment">
                <input name="hidRefID" type="hidden" id="hidRefID" value="<?php echo $modID; ?>">
                <div class="input_field_title">
                    Сэтгэгдэл нэмэх
                </div>
                <div id="divName" class="input_field">
                     <label for="lblName">Нэр</label>
                     <input class="mediumfield" name="txtName" id="txtName" type="text" maxlength="180"/>
                </div>
                <div id="divShort" class="input_field">
                     <label for="lblShort">Сэтгэгдэл</label>
                     <textarea class="textbox" cols="90" rows="2" id="txtShort" name="txtShort" style="width: 600px;" onKeyPress="chkOnlyCounter(this, 450);" ></textarea>
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
                <?php if($errorMessageComment != '&nbsp;'){ ?>
                <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessageComment; ?></p></div>
                <?php } ?>
                <?php if($successMessageComment != '&nbsp;'){ ?>
                <div class="success"><span><?php echo $msgSuccess; ?></span><p><?php echo $successMessageComment; ?></p></div>
                <?php } ?>
                <input class="submit" type="button" id="btnAdd" name="btnAdd" value="Хадгалах" onClick="checkCommentForm();">
                <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php?view=modify&id=<?php echo $modID?>';"> 
            </form>            
            <?php
            }
            else
            {
                $sqlCommentModify = "SELECT * FROM menu_comment WHERE ID = $comment";
                $resultCommentModify  = dbQuery($sqlCommentModify);
                if(dbNumRows($resultCommentModify)>0)
                {
                    $rowCommentModify = dbFetchAssoc($resultCommentModify);
            ?>
            <form action="execute.php?action=modifyComment" method="post" enctype="multipart/form-data" name="frmComment" id="frmComment">
                <input name="hidID" type="hidden" id="hidID" value="<?php echo $rowCommentModify['ID']; ?>">
                <input name="hidRefID" type="hidden" id="hidRefID" value="<?php echo $modID; ?>">
                <div class="input_field_title">
                    Сэтгэгдэл засах
                </div>
                <div id="divName" class="input_field">
                    <label for="lblName">Нэр</label>
                    <input class="mediumfield" name="txtName" id="txtName" type="text" maxlength="180" value="<?php echo stripslashes($rowCommentModify['Name']); ?>"/>
                </div>
                <div id="divShort" class="input_field">
                    <label for="lblShort">Сэтгэгдэл</label>
                    <textarea class="textbox" cols="90" rows="2" id="txtShort" name="txtShort" style="width: 600px;" onKeyPress="chkOnlyCounter(this, 450);" ><?php echo stripslashes($rowCommentModify['Short']); ?></textarea>
                </div>
                <div id="divIsActive"  class="input_field">
                    <label for="txtIsActive">Статус</label>
                    <select class="mediumfield" id="txtIsActive" name="txtIsActive">
                        <option value="1" <?php if(stripslashes($rowCommentModify['IsActive']) == 1) echo 'selected="selected"'; ?>>Идэвхитэй</option>
                        <option value="0" <?php if(stripslashes($rowCommentModify['IsActive']) == 0) echo 'selected="selected"'; ?>>Идэвхигүй</option>                
                    </select>
                    <span class="spanIsActive">идэвхитэй бичлэг сайт дээр харагдана</span>
                </div>
                <br/>
                <?php if($errorMessageComment != '&nbsp;'){ ?>
                <div class="error"><span><?php echo $msgError; ?></span><p><?php echo $errorMessageComment; ?></p></div>
                <?php } ?>
                <?php if($successMessageComment != '&nbsp;'){ ?>
                <div class="success"><span><?php echo $msgSuccess; ?></span><p><?php echo $successMessageComment; ?></p></div>
                <?php } ?>
                <input class="submit" type="button" id="btnAdd" name="btnAdd" value="Хадгалах" onClick="checkCommentFormModify();">
                <input class="submit" type="button" id="btnCancel" name="btnCancel" value="Болих" onClick="window.location.href='index.php?view=modify&id=<?php echo $modID?>';">
            </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</fieldset>
<?php
}
else
    header('Location: index.php');    
?>
