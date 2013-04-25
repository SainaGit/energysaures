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
        
    case 'picture' :
        $ID   = (int)$_GET['id'];                           
        deletePicture($ID, 1);
        header('Location: index.php?view=modify&id=' . $ID . '&success='. urlencode('Зургийг амжилттай устгалаа.'));              
        break;
    
    default :
        header('Location: index.php');
}

function add()
{
    $txtName = addslashes($_POST['txtName']);
    $txtLink = addslashes($_POST['txtLink']);
    $txtIsActive = addslashes($_POST['txtIsActive']);
    
    $images = uploadPicture('txtPicture', SRV_ROOT . BANNER_IMAGES_DIR);
    $mainImage = $images['image'];
    $thumbnailImage = $images['thumbnail'];   
    
    $sql = "INSERT INTO banner (DateCreated, DateModified, Name, Link, Image, IsActive)
            VALUES (NOW(), NOW(), '$txtName', '$txtLink', '$mainImage&$thumbnailImage', '$txtIsActive')";
    dbQuery($sql);        
    
    $ID = dbInsertId();
    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай нэмлээ.'));
}

function modify()
{
    $ID   = (int)$_POST['hidID'];

    $txtName = addslashes($_POST['txtName']);
    $txtLink = addslashes($_POST['txtLink']);
    $txtIsActive = addslashes($_POST['txtIsActive']);

    $images = uploadPicture('txtPicture', SRV_ROOT . BANNER_IMAGES_DIR);
    $mainImage = $images['image'];
    $thumbnailImage = $images['thumbnail'];
    
    if ($mainImage != '')
    {
        deletePicture($ID, 0);        
        $mainImage = "$mainImage";
        $thumbnailImage = "$thumbnailImage";        
    }
    else
    {        
        $sql_pic = "SELECT Image FROM banner WHERE id = $ID";
        $result_pic = dbQuery($sql_pic);
        $row_pic    = dbFetchAssoc($result_pic);
        
        $images = explode("&", $row_pic['Image']);
        $mainImage = $images[0];
        $thumbnailImage = $images[1];
    }
    
    $sql = "UPDATE banner
            SET DateModified=NOW(), 
                Name='$txtName', Link='$txtLink',
                Image='$mainImage&$thumbnailImage', IsActive='$txtIsActive'
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
    
    deletePicture($ID, 0);
    
    dbQuery("DELETE FROM banner WHERE ID = $ID");    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай устгалаа.'));
}

function deletePicture($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image 
            FROM banner
            WHERE ID = $ID";
    $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());
    
    if (dbNumRows($result))
    {
        $row = dbFetchAssoc($result);
        extract($row);
        
        if ($Image && $Image != '&')
        {            
            $images = explode("&", $Image);
            $mainImg = $images[0];
            $thumbImg = $images[1];
            
            $deleted = @unlink(SRV_ROOT . BANNER_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT . BANNER_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE banner 
                SET Image = '&'
                WHERE ID = $ID";
        $result = dbQuery($sql) or die('Энэ зургийг устгах боломжгүй. ' . mysql_error());  
    }
    
    return $deleted;
}
?>