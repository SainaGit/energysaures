<?php
function checkUser()
{
    if (!isset($_SESSION['codesaur_user_id']))
    {
        header('Location: '.CMS_ROOT.'login.php');
        exit;
    }
   
    if (isset($_GET['logout']))
        doLogout();
}

function doLogin()
{
    $errorMessage = '';
    
    $userName = addslashes($_POST['txtUserName']);
    $password = addslashes($_POST['txtPassword']);
    
    if ($userName == '')
        $errorMessage = 'Нэвтрэх нэр талбарыг оруулна уу.';
    else 
        if ($password == '') 
            $errorMessage = 'Нууц үг талбарыг оруулна уу.';
        else 
        {
            $sql = "SELECT * FROM admin WHERE UserName = '$userName' AND Password = md5('$password')";
            $result = dbQuery($sql);
    
            if (dbNumRows($result) == 1)
            {
                $row = dbFetchAssoc($result); 
                if($row['IsActive']=='1')
                {
                    $_SESSION['codesaur_user_id'] = $row['ID'];
                    $_SESSION['codesaur_user_name'] = $row['UserName'];
                    $_SESSION['codesaur_first_name'] = $row['FirstName'];
                    $_SESSION['codesaur_last_name'] = $row['LastName'];
                    $_SESSION['codesaur_email_address'] = $row['Email'];
                    $_SESSION['codesaur_user_role'] = $row['Role'];
                
                    if (isset($_SESSION['codesaur_login_return_url'])) 
                    {
                        header('Location: ' . $_SESSION['codesaur_login_return_url']);
                        exit;
                    } 
                    else
                    {
                        header('Location: index.php');
                        exit;
                    }
                }
                else
                    $errorMessage = 'Нэвтрэх эрх идэвхигүй байна.';
            } 
            else
                $errorMessage = 'Нэвтрэх нэр эсвэл нууц үг буруу байна.';
        }
    return $errorMessage;
}

function doLogout()
{
    if (isset($_SESSION['codesaur_user_id'])) 
    {
        unset($_SESSION['codesaur_user_id']);
        session_unregister('codesaur_user_id');
    }
    
    if (isset($_SESSION['codesaur_user_name']))
    {
        unset($_SESSION['codesaur_user_name']);
        session_unregister('codesaur_user_name');
    }
    
    if (isset($_SESSION['codesaur_first_name'])) 
    {
        unset($_SESSION['codesaur_first_name']);
        session_unregister('codesaur_first_name');
    }
    
    if (isset($_SESSION['codesaur_last_name']))
    {
        unset($_SESSION['codesaur_last_name']);
        session_unregister('codesaur_last_name');
    }
    
    if (isset($_SESSION['codesaur_user_role']))
    {
        unset($_SESSION['codesaur_user_role']);
        session_unregister('codesaur_user_role');
    }
    
    if(isset($_SESSION['language']))
    {
        unset($_SESSION['language']);
        session_unregister('language');    
    }
        
    header('Location: '.CMS_ROOT.'login.php');
    exit;
}
       
function createThumbnail($srcFile, $destFile, $width, $quality = 75)
{
    $thumbnail = '';
    
    if (file_exists($srcFile)  && isset($destFile))
    {
        $size      = getimagesize($srcFile);
        $w         = number_format($width, 0, ',', '');
        $h         = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
        
        $thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
    }
    
    return basename($thumbnail);
}

function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
{
    $tmpSrc     = pathinfo(strtolower($srcFile));
    $tmpDest    = pathinfo(strtolower($destFile));
    $size       = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg")
    {
        $destFile  = substr_replace($destFile, 'jpg', -3);
        $dest      = imagecreatetruecolor($w, $h);
        imageantialias($dest, TRUE);
    } 
    else
        if ($tmpDest['extension'] == "png")
        {
            $dest = imagecreatetruecolor($w, $h);
            imageantialias($dest, TRUE);
        }
        else
            return false;

    switch($size[2])
    {
       case 1:
           $src = imagecreatefromgif($srcFile);
           break;
       case 2:
           $src = imagecreatefromjpeg($srcFile);
           break;
       case 3:
           $src = imagecreatefrompng($srcFile);
           break;
       default:
           return false;
           break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

    switch($size[2])
    {
       case 1:
       case 2:
           imagejpeg($dest,$destFile, $quality);
           break;
       case 3:
           imagepng($dest,$destFile);
    }
    return $destFile;
}

function isActive($IsActive)
{
    $status = "";
    if($IsActive) 
        $status = "Идэвхитэй"; 
    else 
        $status = "Идэвхигүй";   
    
    return $status;   
}

function getLanguage($IsActive_mn, $IsActive_en)
{
    $status = "";
    if($IsActive_mn) 
        $status = $status . "Монгол ";
    if($IsActive_en) 
        $status = $status . "Англи ";    
    
    return $status;   
}

function GetMenu($ID)
{
    $row = NULL;
    
    $sql = "SELECT * FROM menu WHERE ID = '$ID'";
    $result = dbQuery($sql);
    
    if(dbNumRows($result) > 0)
        $row = dbFetchAssoc($result);
    
    return $row;
}

function GetProduct($ID)
{
    $row = NULL;
    
    $sql = "SELECT * FROM product WHERE ID = '$ID'";
    $result = dbQuery($sql);
    
    if(dbNumRows($result) > 0)
        $row = dbFetchAssoc($result);
    
    return $row;
}

function GetBrand($ID)
{
    $row = NULL;
    
    $sql = "SELECT * FROM brand WHERE ID = '$ID'";
    $result = dbQuery($sql);
    
    if(dbNumRows($result) > 0)
        $row = dbFetchAssoc($result);
    
    return $row;
}

function GetMainType($ID)
{
    $row = NULL;
    
    $sql = "SELECT * FROM maintype WHERE ID = '$ID'";
    $result = dbQuery($sql);
    
    if(dbNumRows($result) > 0)
        $row = dbFetchAssoc($result);
    
    return $row;
}

function GetProType($ID)
{
    $row = NULL;
    
    $sql = "SELECT * FROM protype WHERE ID = '$ID'";
    $result = dbQuery($sql);
    
    if(dbNumRows($result) > 0)
        $row = dbFetchAssoc($result);
    
    return $row;
}

function GetBanner($ID)
{
    $row = NULL;
    
    $sql = "SELECT * FROM banner WHERE ID = '$ID'";
    $result = dbQuery($sql);
    
    if(dbNumRows($result) > 0)
        $row = dbFetchAssoc($result);
    
    return $row;
}

function showPath($row)
{
    $result = "";
    
    while($row != NULL)
    {
        if($result == "")
            $result = $row['Name_mn'];
        else
            $result = $row['Name_mn'] . " >> " . $result;
        
        
        if($row['ParentID']!=0)
            $row = GetMenu($row['ParentID']);
        else
            $row = NULL;   
    }
    
    return $result;
}

function showProductPath($row)
{
    $result = "";
    
    $result = $row['Name_mn'];
    
    return $result;
}

function showBrandPath($row)
{
    $result = "";
    
    $result = $row['Name'];
    
    return $result;
}

function showMainTypePath($row)
{
    $result = "";
    
    $result = $row['Name_mn'];
    
    return $result;
}

function showProTypePath($row)
{
    $result = "";
    
    $result = $row['Name_mn'];
    
    return $result;
}

function showBannerPath($row)
{
    $result = "";
    
    $result = $row['Name'];
    
    return $result;
}

function js_redirect($url, $seconds=1)
{
    echo "<script language=\"JavaScript\">\n";
    echo "function redirect() {\n";
    echo "window.location = \"" . $url . "\";\n";
    echo "}\n\n";
    echo "timer = setTimeout('redirect()', '" . ($seconds*1000) . "');\n\n";
    echo "</script>\n";

    return true;
}

function GetParentID($ID)
{
    $sql = "SELECT ID, ParentID FROM menu WHERE ID=$ID";
    $result = dbQuery($sql);
    $_SESSION['ParentID'] = $ID;
    
    while($row = dbFetchAssoc($result))
    {
        if($row['ParentID'] != 0)
        {
            $_SESSION['ParentID'] = $row['ParentID'];
            GetParentID($row['ParentID']);
        }
    }
}

function GetChildID($ID)
{
    $sql = "SELECT ID, ParentID FROM menu WHERE ParentID=$ID ORDER BY Rank DESC";
    $result = dbQuery($sql);
    $_SESSION['ChildID'] = $ID;                              
    while($row = dbFetchAssoc($result))
    {
        $_SESSION['ChildID'] = $row['ID'];
        GetChildID($row['ID']);
    }
}

function print_menu($ID, $folder)
{
    $sql = "SELECT * FROM menu WHERE ParentID=$ID ORDER BY Rank";      
    $result = dbQuery($sql);
    
    echo '<ul>';
    while($row = dbFetchAssoc($result))
    {
        if($_SESSION['codesaur_ChildID'] == $row['ID'])
        {
            echo '<li>-<a style="text-decoration:underline" href="index.php?show=content&i='.$row['ID'].'&c=d">' . stripslashes($row['Name_'.$folder]) . '</a>';
            print_menu($row['ID'], $folder);
            echo '</li>';    
        }
        else
        {
            echo '<li>-<a href="index.php?show=content&i='.$row['ID'].'&c=d">' . stripslashes($row['Name_'.$folder]) . '</a>';
            print_menu($row['ID'], $folder);
            echo '</li>';
        }
    }
    echo '</ul>';
}

function uploadPicture($inputName, $uploadDir)
{
    $image          = $_FILES[$inputName];
    $imagePath      = '';
    $thumbnailPath  = '';

    if (trim($image['tmp_name']) != '')
    {
        $ext = substr(strrchr($image['name'], "."), 1);

        $imagePath = md5(rand() * time()) . ".$ext";
        
        list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

        if (LIMIT_IMG_WIDTH && $width > MAX_IMAGE_WIDTH)
        {
            $result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_IMAGE_WIDTH);
            $imagePath = $result;
        } 
        else
            $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
        
        if ($result)
        {
            $thumbnailPath =  md5(rand() * time()) . ".$ext";
            $result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);

            if (!$result)
            {
                unlink($uploadDir . $imagePath);
                $imagePath = $thumbnailPath = '';
            } 
            else
                $thumbnailPath = $result;
        } 
        else
            $imagePath = $thumbnailPath = '';
    }
    return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

function curPageURLMn()
{
    $pageURL = $_SERVER["REQUEST_URI"];
    $pos = strpos($pageURL, '?');
    
    if ($pos == false)
        $pageURL .=  '?lang=mn';            
    else
    {
        $posLang = strpos($pageURL, 'lang=');
        if ($posLang == false)
            $pageURL .=  '&lang=mn';          
        else
            $pageURL = str_replace('lang=en', 'lang=mn', $pageURL);
    }
    return $pageURL;
}

function curPageURLEn()
{
    $pageURL = $_SERVER["REQUEST_URI"];
    $pos = strpos($pageURL, '?');
    
    if ($pos == false)
        $pageURL .=  '?lang=en'; 
    else
    {
        $posLang = strpos($pageURL, 'lang=');
        if ($posLang == false)
            $pageURL .=  '&lang=en';  
        else
            $pageURL = str_replace('lang=mn', 'lang=en', $pageURL);    
    }
    return $pageURL;
}

/*function addComment($textTable, $intReferenceID, $textName, $textEmail, $textIP, $textShort, $intIsActive, $intAddAdmin)
{
    $sql = "INSERT INTO $textTable(DateCreated, DateModified, ReferenceID, Name, Email, IP, Short, Rank, IsActive, AddAdmin, ModifyAdmin)
            VALUES (NOW(), NOW(), '$intReferenceID', '$textName', '$textEmail', '$textIP', '$textShort', '1', '$intIsActive', '$intAddAdmin', '$intAddAdmin')";
    
    dbQuery($sql);
    
    $ID = dbInsertId();
    
    header('Location: index.php?view=modify&id='.$ReferenceID.'&successComment='.urlencode('Бичлэгийг амжилттай нэмлээ.').'#tabs-2');   
}

function modifyComment($textTable, $intID, $intReferenceID, $textName, $textEmail, $textIP, $textShort, $intIsActive, $intModifyAdmin)
{
    $sql = "UPDATE $textTable
            SET DateModified=NOW(), ReferenceID='$intReferenceID', Name='$textName', Short='$textShort', IsActive='$intIsActive', ModifyAdmin='$intModifyAdmin'
            WHERE ID = '$intID'";
    dbQuery($sql);
    
    header('Location: index.php?view=modify&id='.$ReferenceID.'&successComment='.urlencode('Бичлэгийг амжилттай заслаа.').'#tabs-2');   
}

function deleteComment($textTable)
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
    
    dbQuery("DELETE FROM $textTable WHERE ID = $ID");    
    header('Location: index.php?view=modify&id='.$ReferenceID.'&successComment='.urlencode('Бичлэгийг амжилттай устгалаа.').'#tabs-2');
}*/
?>
