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

    default :
        header('Location: index.php');
}

function add()
{
    $txtName = addslashes($_POST['txtName']);
    $txtShort_mn = addslashes($_POST['txtShort_mn']);
    $txtShort_en = addslashes($_POST['txtShort_en']);
    $txtFull_mn = addslashes($_POST['txtFull_mn']);
    $txtFull_en = addslashes($_POST['txtFull_en']);
    
    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);
    
    $txtIsActive = addslashes($_POST['txtIsActive']);
   
    $images1 = uploadPicture('txtPicture1', SRV_ROOT . BRAND_IMAGES_DIR);
    $mainImage1 = $images1['image'];
    $thumbnailImage1 = $images1['thumbnail']; 
  
    $images2 = uploadPicture('txtPicture2', SRV_ROOT . BRAND_IMAGES_DIR);
    $mainImage2 = $images2['image'];
    $thumbnailImage2 = $images2['thumbnail']; 
    
    $sql = "INSERT INTO brand (DateCreated, DateModified,
                Name, Short_mn, Short_en, Full_mn, Full_en, 
                Image1, Image2, 
                Rank, IsActive)
            VALUES (NOW(), NOW(),
                '$txtName', '$txtShort_mn', '$txtShort_en', '$txtFull_mn', '$txtFull_en', 
                '$mainImage1&$thumbnailImage1', '$mainImage2&$thumbnailImage2',
                '$txtRank', '$txtIsActive')";
    dbQuery($sql);        
    
    $ID = dbInsertId();
    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай нэмлээ.'));
}

function modify()
{
    $ID   = (int)$_POST['hidID'];
    
    $txtName = addslashes($_POST['txtName']);
    $txtShort_mn = addslashes($_POST['txtShort_mn']);
    $txtShort_en = addslashes($_POST['txtShort_en']);
    $txtFull_mn = addslashes($_POST['txtFull_mn']);
    $txtFull_en = addslashes($_POST['txtFull_en']);
    
    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);

    $txtIsActive = addslashes($_POST['txtIsActive']);
    
    $images1 = uploadPicture('txtPicture1', SRV_ROOT . BRAND_IMAGES_DIR);
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
        $sql1 = "SELECT Image1 FROM brand WHERE id = $ID";
        $result1 = dbQuery($sql1);
        $row1 = dbFetchAssoc($result1);
        
        $images1 = explode("&", $row1['Image1']);
        $mainImage1 = $images1[0];
        $thumbnailImage1 = $images1[1];
    }
    
    $images2 = uploadPicture('txtPicture2', SRV_ROOT . BRAND_IMAGES_DIR);
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
        $sql2 = "SELECT Image2 FROM brand WHERE id = $ID";
        $result2 = dbQuery($sql2);
        $row2 = dbFetchAssoc($result2);
        
        $images2 = explode("&", $row2['Image2']);
        $mainImage2 = $images2[0];
        $thumbnailImage2 = $images2[1];
    }
   
    $sql = "UPDATE brand
            SET DateModified=NOW(),
                Name='$txtName',
                Short_mn='$txtShort_mn', Short_en='$txtShort_en',  
                Full_mn='$txtFull_mn', Full_en='$txtFull_en', 
                Image1='$mainImage1&$thumbnailImage1', Image2='$mainImage2&$thumbnailImage2', 
                Rank='$txtRank', IsActive='$txtIsActive'
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

    dbQuery("DELETE FROM brand WHERE ID = $ID");    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай устгалаа.'));
}

function deletePicture1($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image1 
            FROM brand
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
            
            $deleted = @unlink(SRV_ROOT. BRAND_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT. BRAND_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE brand 
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
            FROM brand
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
            
            $deleted = @unlink(SRV_ROOT . BRAND_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT . BRAND_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE brand 
                SET Image2 = '&'
                WHERE ID = $ID";
        $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());  
    }
    
    return $deleted;
}
?>