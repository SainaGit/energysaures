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

$sql = "SELECT * FROM product WHERE ID = $modID";
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
        $img1 = WEB_ROOT . PRODUCT_IMAGES_DIR;
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
        $img2 = WEB_ROOT . PRODUCT_IMAGES_DIR;
        $img2 = $img2 . $thumbImg2;
        $img2Del = 1;    
    }
        
    $img3 = WEB_ROOT . NO_IMAGE;
    $img3Del = 0; 
    if($Image3 && $Image3 != "&")
    {
        $images3 = explode("&", stripslashes($Image3));
        $mainImg3 = $images3[0];
        $thumbImg3 = $images3[1];
        $img3 = WEB_ROOT . PRODUCT_IMAGES_DIR;
        $img3 = $img3 . $thumbImg3;
        $img3Del = 1;    
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
            <li><a href="#tabs-1">Бараа бүтээгдхүүн</a></li>
            <li><a href="#tabs-2">Сэтгэгдэл</a></li> 
        </ul>
        <div id="tabs-1">        
            <form action="execute.php?action=modify" method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
                <legend id="legendTitle" ><?php echo $contentTitle; ?></legend>
                <input name="hidID" type="hidden" id="hidID" value="<?php echo $ID; ?>">
                <div id="divBrandID"  class="input_field">
                <label for="txtBrandID">Брэнд</label>
                    <select class="mediumfield" id="txtBrandID" name="txtBrandID">
                        <option value="<?php echo UNKNOWN_ID; ?>"><?php echo UNKNOWN_MN; ?></option>
                        <?php
                            $sqlBrand = "SELECT * FROM brand ORDER BY Rank, DateCreated DESC";
                            $resultBrand = mysql_query($sqlBrand) or die(mysql_error());
                            $countBrand = mysql_num_rows($resultBrand); 
                            if($countBrand > 0)
                            {
                                while($rowBrand = mysql_fetch_assoc($resultBrand))
                                {
                                 //   extract($rowBrand);
                                    if ((int)$rowBrand['ID'] == $BrandID)
                                        echo '<option value="'.$rowBrand['ID'].'" selected="selected">'.$rowBrand['Name'].'</option>';
                                    else 
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
                               // extract($rowMainType);
                                if ((int)$rowMainType['ID'] == $MainType)
                                    echo '<option value="'.$rowMainType['ID'].'" selected="selected">'.$rowMainType['Name_mn'].'</option>';
                                else
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
                                if ((int)$rowMainType['ID'] == $MainType2)
                                    echo '<option value="'.$rowMainType['ID'].'" selected="selected">'.$rowMainType['Name_mn'].'</option>';
                                else
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
                                if ((int)$rowMainType['ID'] == $MainType3)
                                    echo '<option value="'.$rowMainType['ID'].'" selected="selected">'.$rowMainType['Name_mn'].'</option>';
                                else
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
                                //extract($rowProType);
                                if ((int)$rowProType['ID'] == $ProType)
                                    echo '<option value="'.$rowProType['ID'].'" selected="selected">'.$rowProType['Name_mn'].'</option>';
                                else
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
                <div id="divPictureChoose1" class="input_field">
                     <label for="txtPictureChoose1">Одоогийн зураг 1</label>
                     <img style="float: left; display: block;" id="imgPictureChoose1" name="imgPictureChoose1" src="<?php echo $img1; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($img1Del) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'product/execute.php?action=picture1&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divPicture2" class="input_field">
                     <label for="txtPicture2">Зураг 2</label>
                     <input class="bigfield" name="txtPicture2" type="file" id="txtPicture2" />
                </div>
                <div id="divPictureChoose2" class="input_field">
                     <label for="txtPictureChoose2">Одоогийн зураг 2</label>
                     <img style="float: left; display: block;" id="imgPictureChoose2" name="imgPictureChoose2" src="<?php echo $img2; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($img2Del) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'product/execute.php?action=picture2&id=' . $ID; ?>"> зураг устгах</a>
                     </div>
                     <?php } ?>
                     <div class="clear">
                     </div>
                </div>
                <div id="divPicture3" class="input_field">
                     <label for="txtPicture3">Зураг 3</label>
                     <input class="bigfield" name="txtPicture3" type="file" id="txtPicture3" />
                </div>
                <div id="divPictureChoose3" class="input_field">
                     <label for="txtPictureChoose3">Одоогийн зураг 3</label>
                     <img style="float: left; display: block;" id="imgPictureChoose3" name="imgPictureChoose3" src="<?php echo $img3; ?>" width="<?php echo THUMBNAIL_WIDTH; ?>px"/>
                     <?php if($img3Del) { ?>
                     <div style="float: left; margin-left: 10px; margin-top: 10px;"> 
                        <a href="<?php echo CMS_ROOT . 'product/execute.php?action=picture3&id=' . $ID; ?>"> зураг устгах</a>
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
                    <textarea cols="" rows="" class="<?php echo HTML_EDITOR; ?>" name="txtFull_mn" id="txtFull_mn" ><?php echo stripslashes($Full_mn); ?></textarea>
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
                <div id="divIsActive_mn"  class="input_field">
                    <label for="txtIsActive_mn">Статус</label>
                    <select class="mediumfield" id="txtIsActive_mn" name="txtIsActive_mn">
                        <option value="1" <?php if($IsActive_mn == 1) echo 'selected="selected"'; ?> >Идэвхитэй</option>
                        <option value="0" <?php if($IsActive_mn == 0) echo 'selected="selected"'; ?> >Идэвхигүй</option>                
                    </select>
                    <span class="spanIsActive_mn">идэвхитэй бичлэг сайт дээр харагдана</span>
                </div>
                <div id="divIsActive_en"  class="input_field">
                    <label for="txtIsActive_en">Статус (англи)</label>
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
            $sqlComment = "SELECT * FROM product_comment WHERE ReferenceID = $modID ORDER BY DateCreated DESC";
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
                $sqlCommentModify = "SELECT * FROM product_comment WHERE ID = $comment";
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
