<?php
require_once '../configu.php';
require_once '../include/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action)
{
    case 'add' :
        add();
        break;
        
    case 'modify' :
        modify();
        break;
        
    case 'delete' :
        delete();
        break;
    
    case 'picture1' :
        $ID   = (int)$_GET['id'];                           
        deletePicture1($ID, 1);
        header('Location: index.php?view=modify&id=' . $ID . '&success='. urlencode('Зургийг амжилттай устгалаа.'));              
        break;
    
    case 'picture2' :
        $ID   = (int)$_GET['id'];                           
        deletePicture2($ID, 1);
        header('Location: index.php?view=modify&id=' . $ID . '&success='. urlencode('Зургийг амжилттай устгалаа.'));              
        break;    
   
    case 'picture3' :
        $ID   = (int)$_GET['id'];                           
        deletePicture3($ID, 1);
        header('Location: index.php?view=modify&id=' . $ID . '&success='. urlencode('Зургийг амжилттай устгалаа.'));              
        break;  
    
    case 'addComment' :
        addComment();
        break;
        
    case 'modifyComment' :
        modifyComment();
        break;
        
    case 'deleteComment' :
        deleteComment();
        break;
    
    default :
        header('Location: index.php');
}

function add()
{
    $txtName_mn = addslashes($_POST['txtName_mn']);
    $txtName_en = addslashes($_POST['txtName_en']);
    $txtShort_mn = addslashes($_POST['txtShort_mn']);
    $txtShort_en = addslashes($_POST['txtShort_en']);
    $txtFull_mn = addslashes($_POST['txtFull_mn']);
    $txtFull_en = addslashes($_POST['txtFull_en']);
    
    $txtBrandID = addslashes($_POST['txtBrandID']);
    $txtMainType = addslashes($_POST['txtMainType']);
    $txtMainType2 = addslashes($_POST['txtMainType2']);
    $txtMainType3 = addslashes($_POST['txtMainType3']);
    $txtProType = addslashes($_POST['txtProType']);

    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);
    
    $txtIsActive_mn = addslashes($_POST['txtIsActive_mn']);
    $txtIsActive_en = addslashes($_POST['txtIsActive_en']);
       
    $txtShowComment = addslashes($_POST['txtShowComment']);
    $txtCanComment = addslashes($_POST['txtCanComment']); 
    
    $images1 = uploadPicture('txtPicture1', SRV_ROOT . PRODUCT_IMAGES_DIR);
    $mainImage1 = $images1['image'];
    $thumbnailImage1 = $images1['thumbnail']; 
  
    $images2 = uploadPicture('txtPicture2', SRV_ROOT . PRODUCT_IMAGES_DIR);
    $mainImage2 = $images2['image'];
    $thumbnailImage2 = $images2['thumbnail']; 

    $images3 = uploadPicture('txtPicture3', SRV_ROOT . PRODUCT_IMAGES_DIR);
    $mainImage3 = $images3['image'];
    $thumbnailImage3 = $images3['thumbnail']; 
    
    $sql = "INSERT INTO product (DateCreated, DateModified, BrandID,
                Name_mn, Name_en, 
                Short_mn, Short_en,  
                Full_mn, Full_en, 
                Image1, Image2, Image3,
                MainType, MainType2, MainType3,
                ProType, Rank,
                IsActive_mn, IsActive_en,
                ShowComment, CanComment)
            VALUES (NOW(), NOW(), '$txtBrandID',
                '$txtName_mn', '$txtName_en',
                '$txtShort_mn', '$txtShort_en', 
                '$txtFull_mn', '$txtFull_en',
                '$mainImage1&$thumbnailImage1', '$mainImage2&$thumbnailImage2', '$mainImage3&$thumbnailImage3',
                '$txtMainType', '$txtMainType2', '$txtMainType3',
                '$txtProType', '$txtRank',
                '$txtIsActive_mn', '$txtIsActive_en',
                '$txtShowComment', '$txtCanComment')";
    dbQuery($sql);        
    
    $ID = dbInsertId();
    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай нэмлээ.'));
}

function modify()
{
    $ID   = (int)$_POST['hidID'];
   
    $txtName_mn = addslashes($_POST['txtName_mn']);
    $txtName_en = addslashes($_POST['txtName_en']);
    $txtShort_mn = addslashes($_POST['txtShort_mn']);
    $txtShort_en = addslashes($_POST['txtShort_en']);
    $txtFull_mn = addslashes($_POST['txtFull_mn']);
    $txtFull_en = addslashes($_POST['txtFull_en']);
    
    $txtBrandID = addslashes($_POST['txtBrandID']);
    $txtMainType = addslashes($_POST['txtMainType']);
    $txtMainType2 = addslashes($_POST['txtMainType2']);
    $txtMainType3 = addslashes($_POST['txtMainType3']);
    $txtProType = addslashes($_POST['txtProType']); 

    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);
    
    $txtIsActive_mn = addslashes($_POST['txtIsActive_mn']);
    $txtIsActive_en = addslashes($_POST['txtIsActive_en']);
    
    $txtShowComment = addslashes($_POST['txtShowComment']);
    $txtCanComment = addslashes($_POST['txtCanComment']);
    
    $images1 = uploadPicture('txtPicture1', SRV_ROOT . PRODUCT_IMAGES_DIR);
    $mainImage1 = $images1['image'];
    $thumbnailImage1 = $images1['thumbnail'];
    if ($mainImage1 != '')
    {
        deletePicture1($ID, 0);        
        $mainImage1 = "$mainImage1";
        $thumbnailImage1 = "$thumbnailImage1";        
    }
    else
    {        
        $sql1 = "SELECT Image1 FROM product WHERE id = $ID";
        $result1 = dbQuery($sql1);
        $row1 = dbFetchAssoc($result1);
        
        $images1 = explode("&", $row1['Image1']);
        $mainImage1 = $images1[0];
        $thumbnailImage1 = $images1[1];
    }
        
    $images2 = uploadPicture('txtPicture2', SRV_ROOT . PRODUCT_IMAGES_DIR);
    $mainImage2 = $images2['image'];
    $thumbnailImage2 = $images2['thumbnail'];
    if ($mainImage2 != '')
    {
        deletePicture2($ID, 0);        
        $mainImage2 = "$mainImage2";
        $thumbnailImage2 = "$thumbnailImage2";        
    }
    else
    {        
        $sql2 = "SELECT Image2 FROM product WHERE id = $ID";
        $result2 = dbQuery($sql2);
        $row2 = dbFetchAssoc($result2);
        
        $images2 = explode("&", $row2['Image2']);
        $mainImage2 = $images2[0];
        $thumbnailImage2 = $images2[1];
    }
   
    $images3 = uploadPicture('txtPicture3', SRV_ROOT . PRODUCT_IMAGES_DIR);
    $mainImage3 = $images3['image'];
    $thumbnailImage3 = $images3['thumbnail'];
    if ($mainImage3 != '')
    {
        deletePicture3($ID, 0);        
        $mainImage3 = "$mainImage3";
        $thumbnailImage3 = "$thumbnailImage3";        
    }
    else
    {        
        $sql3 = "SELECT Image3 FROM product WHERE id = $ID";
        $result3 = dbQuery($sql3);
        $row3 = dbFetchAssoc($result3);
        
        $images3 = explode("&", $row3['Image3']);
        $mainImage3 = $images3[0];
        $thumbnailImage3 = $images3[1];
    }
   
    $sql = "UPDATE product
            SET DateModified=NOW(), BrandID='$txtBrandID',
                Name_mn='$txtName_mn', Name_en='$txtName_en',
                Short_mn='$txtShort_mn', Short_en='$txtShort_en',
                Full_mn='$txtFull_mn', Full_en='$txtFull_en', 
                Image1='$mainImage1&$thumbnailImage1', Image2='$mainImage2&$thumbnailImage2', Image3='$mainImage3&$thumbnailImage3',
                MainType='$txtMainType', MainType2='$txtMainType2', MainType3='$txtMainType3', 
                ProType='$txtProType', Rank='$txtRank', 
                IsActive_mn='$txtIsActive_mn',IsActive_en='$txtIsActive_en',
                ShowComment='$txtShowComment', CanComment='$txtCanComment'
            WHERE ID = '$ID'";
    dbQuery($sql);        
    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай заслаа.'));  
}

function delete()
{
    if (isset($_GET['id']) && (int)$_GET['id'] > 0)
        $ID = (int)$_GET['id'];
    else
        header('Location: index.php');
    
    deletePicture1($ID, 0);
    deletePicture2($ID, 0);
    deletePicture3($ID, 0);

    dbQuery("DELETE FROM product_comment WHERE ReferenceID = $ID");
    dbQuery("DELETE FROM product WHERE ID = $ID");    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай устгалаа.'));
}

function deletePicture1($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image1 
            FROM product
            WHERE ID = $ID";
    $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());
    
    if (dbNumRows($result))
    {
        $row = dbFetchAssoc($result);
        extract($row);
        
        if ($Image1 && $Image1 != '&')
        {            
            $images = explode("&", $Image1);
            $mainImg = $images[0];
            $thumbImg = $images[1];
            
            $deleted = @unlink(SRV_ROOT. PRODUCT_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT .PRODUCT_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE product 
                SET Image1 = '&'
                WHERE ID = $ID";
        $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());  
    }
    
    return $deleted;
}

function deletePicture2($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image2 
            FROM product
            WHERE ID = $ID";
    $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());
    
    if (dbNumRows($result))
    {
        $row = dbFetchAssoc($result);
        extract($row);
        
        if ($Image2 && $Image2 != '&')
        {            
            $images = explode("&", $Image2);
            $mainImg = $images[0];
            $thumbImg = $images[1];
            
            $deleted = @unlink(SRV_ROOT . PRODUCT_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT . PRODUCT_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE product 
                SET Image2 = '&'
                WHERE ID = $ID";
        $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());  
    }
    
    return $deleted;
}

function deletePicture3($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image3 
            FROM product
            WHERE ID = $ID";
    $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());
    
    if (dbNumRows($result))
    {
        $row = dbFetchAssoc($result);
        extract($row);
        
        if ($Image3 && $Image3 != '&')
        {            
            $images = explode("&", $Image3);
            $mainImg = $images[0];
            $thumbImg = $images[1];
            
            $deleted = @unlink(SRV_ROOT . PRODUCT_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT . PRODUCT_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE product 
                SET Image3 = '&'
                WHERE ID = $ID";
        $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());  
    }
    
    return $deleted;
}

function addComment()
{
    $ReferenceID = (int)$_POST['hidRefID'];
    
    $txtName = addslashes($_POST['txtName']);
    $txtIP = '';
    $txtShort = addslashes($_POST['txtShort']);
    $txtIsActive = addslashes($_POST['txtIsActive']);
    
    $sql = "INSERT INTO product_comment(DateCreated, DateModified, ReferenceID, Name, Email, IP, Short, Rank, IsActive)
            VALUES (NOW(), NOW(), '$ReferenceID', '$txtName', '', '$txtIP', '$txtShort', '1', '$txtIsActive')";
    
    dbQuery($sql);
    
    $ID = dbInsertId();
    
    header('Location: index.php?view=modify&id='.$ReferenceID.'&successComment='.urlencode('Бичлэгийг амжилттай нэмлээ.').'#tabs-2');   
}

function modifyComment()
{
    $ReferenceID = (int)$_POST['hidRefID'];
    $ID   = (int)$_POST['hidID'];
    
    $txtName = addslashes($_POST['txtName']);
    $txtShort = addslashes($_POST['txtShort']);
    $txtIsActive = addslashes($_POST['txtIsActive']);
    
    $sql = "UPDATE product_comment
            SET DateModified=NOW(), ReferenceID='$ReferenceID', Name='$txtName', Short='$txtShort', IsActive='$txtIsActive'
            WHERE ID = '$ID'";
    dbQuery($sql);
    
    header('Location: index.php?view=modify&id='.$ReferenceID.'&successComment='.urlencode('Бичлэгийг амжилттай заслаа.').'#tabs-2');   
}

function deleteComment()
{
    if (isset($_GET['id']) && (int)$_GET['id'] > 0)
    {
        $ID = (int)$_GET['id'];
        if (isset($_GET['refID']) && (int)$_GET['refID'] > 0)
            $ReferenceID = (int)$_GET['refID'];
        else
            header('Location: index.php');
    } 
    else
        header('Location: index.php');
    
    dbQuery("DELETE FROM product_comment WHERE ID = $ID");    
    header('Location: index.php?view=modify&id='.$ReferenceID.'&successComment='.urlencode('Бичлэгийг амжилттай устгалаа.').'#tabs-2');
}
?>