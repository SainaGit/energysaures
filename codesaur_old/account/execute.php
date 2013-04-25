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
    
    default :
        header('Location: index.php');
}

function add()
{
    $txtUserName = addslashes($_POST['txtUserName']);
    $txtPassword = addslashes($_POST['txtPassword']);
    $txtFirstName = addslashes($_POST['txtFirstName']);
    $txtLastName = addslashes($_POST['txtLastName']);
    $txtEmail = addslashes($_POST['txtEmail']);
    $txtRole = 'admin';
    $txtIsActive = addslashes($_POST['txtIsActive']);        
    
    $sql = "SELECT * FROM admin WHERE UserName = '$txtUserName'";
    $result = dbQuery($sql);
    
    if (dbNumRows($result) == 1)
        header('Location: index.php?view=add&error=' . urlencode('This User Name already registered. Please enter different User Name.'));    
    else
    { 
        $sql   = "INSERT INTO admin (DateCreated, DateModified, UserName, Password, FirstName, LastName, Email, Role, IsActive)
                  VALUES (NOW(), NOW(), '$txtUserName', md5('$txtPassword'), '$txtFirstName', '$txtLastName', '$txtEmail', '$txtRole', '$txtIsActive')";
        dbQuery($sql);        
        
        $ID = dbInsertId();
        
        header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай нэмлээ.'));
    }
}

function modify()
{
    $ID   = (int)$_POST['hidID'];
    $txtUserName = addslashes($_POST['txtUserName']);
    $txtPassword = addslashes($_POST['txtPassword']);
    $txtFirstName = addslashes($_POST['txtFirstName']);
    $txtLastName = addslashes($_POST['txtLastName']);
    $txtEmail = addslashes($_POST['txtEmail']);
    $txtIsActive = addslashes($_POST['txtIsActive']);        
    
    $sql = "SELECT * FROM admin WHERE UserName = '$txtUserName'";
    $result = dbQuery($sql);
    if (dbNumRows($result) > 0)
    {
        $row = dbFetchAssoc($result);
        if($ID == (int)$row['ID'])
        {
            if($txtPassword == "")
            {
                $sql   = "UPDATE admin SET DateModified = NOW(), UserName = '$txtUserName', FirstName = '$txtFirstName',
                          LastName = '$txtLastName', Email = '$txtEmail', IsActive = '$txtIsActive' WHERE ID = '$ID'";    
            } 
            else
            {
                $sql   = "UPDATE admin SET DateModified = NOW(), UserName = '$txtUserName', Password = md5('$txtPassword'), FirstName = '$txtFirstName',
                          LastName = '$txtLastName', Email = '$txtEmail', IsActive = '$txtIsActive' WHERE ID = '$ID'";        
            }
            dbQuery($sql);        
            
            header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай заслаа.'));               
        }
        else
            header('Location: index.php?view=modify&id='. $ID .'&error=' . urlencode('Нэвтрэх Нэр бүртгэгдсэн байна. Өөр Нэвтрэх Нэр оруулна уу.'));     
    }
    else
    {
        if($txtPassword == "")
        {
            $sql   = "UPDATE admin SET DateModified = NOW(), UserName = '$txtUserName', FirstName = '$txtFirstName',
                      LastName = '$txtLastName', Email = '$txtEmail', IsActive = '$txtIsActive' WHERE ID = '$ID'";    
        } 
        else
        {
            $sql   = "UPDATE admin SET DateModified = NOW(), UserName = '$txtUserName', Password = md5('$txtPassword'), FirstName = '$txtFirstName',
                      LastName = '$txtLastName', Email = '$txtEmail', IsActive = '$txtIsActive' WHERE ID = '$ID'";        
        }
        dbQuery($sql);        

        header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай заслаа.'));
    }  
}

function delete()
{
    if (isset($_GET['id']) && (int)$_GET['id'] > 0)
        $ID = (int)$_GET['id'];
    else
        header('Location: index.php');
    
    dbQuery("DELETE FROM admin WHERE ID = $ID");    
    header('Location: index.php?success='. urlencode('Бичлэгийг амжилттай устгалаа.'));
}
?>
