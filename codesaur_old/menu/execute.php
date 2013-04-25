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
    $txtParentID = addslashes($_POST['txtParentID']);
    $txtName_mn = addslashes($_POST['txtName_mn']);
    $txtName_en = addslashes($_POST['txtName_en']);
    
    $txtShort_mn = addslashes($_POST['txtShort_mn']);
    $txtShort_en = addslashes($_POST['txtShort_en']);
    
    $txtFull_mn = addslashes($_POST['txtFull_mn']);
    $txtFull_en = addslashes($_POST['txtFull_en']);
    
    $txtType = addslashes($_POST['txtType']);
    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);
    
    $txtIsActive_mn = addslashes($_POST['txtIsActive_mn']);
    $txtIsActive_en = addslashes($_POST['txtIsActive_en']);
       
    $txtShowComment = addslashes($_POST['txtShowComment']);
    $txtCanComment = addslashes($_POST['txtCanComment']); 
    
    $images_mn = uploadPicture('txtPicture_mn', SRV_ROOT . MENU_IMAGES_DIR);
    $mainImage_mn = $images_mn['image'];
    $thumbnailImage_mn = $images_mn['thumbnail']; 
  
    $images_en = uploadPicture('txtPicture_en', SRV_ROOT . MENU_IMAGES_DIR);
    $mainImage_en = $images_en['image'];
    $thumbnailImage_en = $images_en['thumbnail']; 
    
    $sql = "INSERT INTO menu (DateCreated, DateModified, ParentID,
                Name_mn, Name_en, 
                Short_mn, Short_en,  
                Full_mn, Full_en, 
                Image_mn, Image_en,
                Type, Rank,
                IsActive_mn, IsActive_en,
                ShowComment, CanComment)
            VALUES (NOW(), NOW(), '$txtParentID',
                '$txtName_mn', '$txtName_en',
                '$txtShort_mn', '$txtShort_en', 
                '$txtFull_mn', '$txtFull_en',
                '$mainImage_mn&$thumbnailImage_mn', '$mainImage_en&$thumbnailImage_en',
                '$txtType', '$txtRank',
                '$txtIsActive_mn', '$txtIsActive_en',
                '$txtShowComment', '$txtCanComment')";
    dbQuery($sql);        
    
    $ID = dbInsertId();
    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай нэмлээ.'));
}

function modify()
{
    $ID   = (int)$_POST['hidID'];
    $txtParentID = addslashes($_POST['txtParentID']);
    $txtName_mn = addslashes($_POST['txtName_mn']);
    $txtName_en = addslashes($_POST['txtName_en']);
    
    $txtShort_mn = addslashes($_POST['txtShort_mn']);
    $txtShort_en = addslashes($_POST['txtShort_en']);
    
    $txtFull_mn = addslashes($_POST['txtFull_mn']);
    $txtFull_en = addslashes($_POST['txtFull_en']);
    
    $txtType = addslashes($_POST['txtType']); 
    $txtRank = 0;
    if(isset($_POST['txtRank']))
        $txtRank = addslashes($_POST['txtRank']);
    
    $txtIsActive_mn = addslashes($_POST['txtIsActive_mn']);
    $txtIsActive_en = addslashes($_POST['txtIsActive_en']);
    
    $txtShowComment = addslashes($_POST['txtShowComment']);
    $txtCanComment = addslashes($_POST['txtCanComment']);
    
    $images_mn = uploadPicture('txtPicture_mn', SRV_ROOT . MENU_IMAGES_DIR);
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
        $sql_mn = "SELECT Image_mn FROM menu WHERE id = $ID";
        $result_mn = dbQuery($sql_mn);
        $row_mn = dbFetchAssoc($result_mn);
        
        $images_mn = explode("&", $row_mn['Image_mn']);
        $mainImage_mn = $images_mn[0];
        $thumbnailImage_mn = $images_mn[1];
    }
    
    $images_en = uploadPicture('txtPicture_en', SRV_ROOT . MENU_IMAGES_DIR);
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
        $sql_en = "SELECT Image_en FROM menu WHERE id = $ID";
        $result_en = dbQuery($sql_en);
        $row_en = dbFetchAssoc($result_en);
        
        $images_en = explode("&", $row_en['Image_en']);
        $mainImage_en = $images_en[0];
        $thumbnailImage_en = $images_en[1];
    }
    
    $sql = "UPDATE menu
            SET DateModified=NOW(), ParentID='$txtParentID',
                Name_mn='$txtName_mn', Name_en='$txtName_en',
                Short_mn='$txtShort_mn', Short_en='$txtShort_en',
                Image_mn='$mainImage_mn&$thumbnailImage_mn', Image_en='$mainImage_en&$thumbnailImage_en', 
                Full_mn='$txtFull_mn', Full_en='$txtFull_en', 
                Type='$txtType', Rank='$txtRank', 
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
    
    deletePicture_mn($ID, 0);
    deletePicture_en($ID, 0);
    
    dbQuery("DELETE FROM menu_comment WHERE ReferenceID = $ID");
    dbQuery("DELETE FROM menu WHERE ID = $ID");    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай устгалаа.'));
}

function deletePicture_mn($ID, $IsCheck)
{
    $deleted = false;
    
    $sql = "SELECT Image_mn 
            FROM menu
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
            
            $deleted = @unlink(SRV_ROOT. MENU_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT .MENU_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE menu 
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
            FROM menu
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
            
            $deleted = @unlink(SRV_ROOT . MENU_IMAGES_DIR . $mainImg);
            $deleted = @unlink(SRV_ROOT . MENU_IMAGES_DIR . $thumbImg);
        }
    }
    
    if($IsCheck)
    {
        $sql = "UPDATE menu 
                SET Image_en = '&'
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
    
    $sql = "INSERT INTO menu_comment(DateCreated, DateModified, ReferenceID, Name, Email, IP, Short, Rank, IsActive)
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
    
    $sql = "UPDATE menu_comment
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
    
    dbQuery("DELETE FROM menu_comment WHERE ID = $ID");    
    header('Location: index.php?view=modify&id='.$ReferenceID.'&successComment='.urlencode('Бичлэгийг амжилттай устгалаа.').'#tabs-2');
}
?>