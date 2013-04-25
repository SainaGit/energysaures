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
        
    case 'picture_mn' :
        $ID   = (int)$_GET['id'];                           
        deletePicture_mn($ID, 1);
        header('Location: index.php?view=modify&id=' . $ID . '&success='. urlencode('Зургийг амжилттай устгалаа.'));              
        break;
    
    case 'picture_en' :
        $ID   = (int)$_GET['id'];                           
        deletePicture_en($ID, 1);
        header('Location: index.php?view=modify&id=' . $ID . '&success='. urlencode('Зургийг амжилттай устгалаа.'));              
        break;    

    default :
        header('Location: index.php');
}

function add()
{
    $txtName_mn = addslashes($_POST['txtName_mn']);
    $txtName_en = addslashes($_POST['txtName_en']);

    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);
    
    $txtIsActive = addslashes($_POST['txtIsActive']);
   
    $images_mn = uploadPicture('txtPicture_mn', SRV_ROOT . MAINTYPE_IMAGES_DIR);
    $mainImage_mn = $images_mn['image'];
    $thumbnailImage_mn = $images_mn['thumbnail']; 
  
    $images_en = uploadPicture('txtPicture_en', SRV_ROOT . MAINTYPE_IMAGES_DIR);
    $mainImage_en = $images_en['image'];
    $thumbnailImage_en = $images_en['thumbnail']; 
    
    $sql = "INSERT INTO maintype (DateCreated, DateModified,
                Name_mn, Name_en, 
                Image_mn, Image_en, 
                Rank, IsActive)
            VALUES (NOW(), NOW(),
                '$txtName_mn', '$txtName_en',  
                '$mainImage_mn&$thumbnailImage_mn', '$mainImage_en&$thumbnailImage_en',
                '$txtRank', '$txtIsActive')";
    dbQuery($sql);        
    
    $ID = dbInsertId();
    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай нэмлээ.'));
}

function modify()
{
    $ID   = (int)$_POST['hidID'];
    
    $txtName_mn = addslashes($_POST['txtName_mn']);
    $txtName_en = addslashes($_POST['txtName_en']);
    
    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);

    $txtIsActive = addslashes($_POST['txtIsActive']);
    
    $images_mn = uploadPicture('txtPicture_mn', SRV_ROOT . MAINTYPE_IMAGES_DIR);
    $mainImage_mn = $images_mn['image'];
    $thumbnailImage_mn = $images_mn['thumbnail'];
    
    if ($mainImage_mn != '')
    {
        deletePicture_mn($ID, 0);        
        $mainImage_mn = "$mainImage_mn";
        $thumbnailImage_mn = "$thumbnailImage_mn";        
    }
    else
    {        
        $sql_mn = "SELECT Image_mn FROM maintype WHERE id = $ID";
        $result_mn = dbQuery($sql_mn);
        $row_mn = dbFetchAssoc($result_mn);
        
        $images_mn = explode("&", $row_mn['Image_mn']);
        $mainImage_mn = $images_mn[0];
        $thumbnailImage_mn = $images_mn[1];
    }
    
    $images_en = uploadPicture('txtPicture_en', SRV_ROOT . MAINTYPE_IMAGES_DIR);
    $mainImage_en = $images_en['image'];
    $thumbnailImage_en = $images_en['thumbnail'];
    
    if ($mainImage_en != '')
    {
        deletePicture_en($ID, 0);        
        $mainImage_en = "$mainImage_en";
        $thumbnailImage_en = "$thumbnailImage_en";        
    }
    else
    {        
        $sql_en = "SELECT Image_en FROM maintype WHERE id = $ID";
        $result_en = dbQuery($sql_en);
        $row_en = dbFetchAssoc($result_en);
        
        $images_en = explode("&", $row_en['Image_en']);
        $mainImage_en = $images_en[0];
        $thumbnailImage_en = $images_en[1];
    }
   
    $sql = "UPDATE maintype
            SET DateModified=NOW(),
                Name_mn='$txtName_mn', Name_en='$txtName_en',
                Image_mn='$mainImage_mn&$thumbnailImage_mn', Image_en='$mainImage_en&$thumbnailImage_en', 
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
    
    deletePicture_mn($ID, 0);
    deletePicture_en($ID, 0);

    dbQuery("DELETE FROM maintype WHERE ID = $ID");    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай устгалаа.'));
}

function deletePicture_mn($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image_mn 
            FROM maintype
            WHERE ID = $ID";
    $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());
    
    if (dbNumRows($result))
    {
        $row = dbFetchAssoc($result);
        extract($row);
        
        if ($Image_mn && $Image_mn != '&')
        {            
            $images = explode("&", $Image_mn);
            $mainImg = $images[0];
            $thumbImg = $images[1];
            
            $deleted = @unlink(SRV_ROOT. MAINTYPE_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT. MAINTYPE_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE maintype 
                SET Image_mn = '&'
                WHERE ID = $ID";
        $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());  
    }
    
    return $deleted;
}

function deletePicture_en($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image_en 
            FROM maintype
            WHERE ID = $ID";
    $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());
    
    if (dbNumRows($result))
    {
        $row = dbFetchAssoc($result);
        extract($row);
        
        if ($Image_en && $Image_en != '&')
        {            
            $images = explode("&", $Image_en);
            $mainImg = $images[0];
            $thumbImg = $images[1];
            
            $deleted = @unlink(SRV_ROOT . MAINTYPE_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT . MAINTYPE_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE maintype 
                SET Image_en = '&'
                WHERE ID = $ID";
        $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());  
    }
    
    return $deleted;
}
?>