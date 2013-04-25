<?php
defined('CODESAUR') || exit(1);

use cdn\Controller;

class AdminController extends Controller
{
    public $styles = array();
    public $jscripts = array();
            
    public function index() {
        parent::index();
        $this->loadModel('Main');
        $this->allwaysCheck();
    }
    
    public function allwaysCheck() {
        $this->loadView('header');
        if (codesaur::instance()->auth->check()) {
            $this->loadView('content');
            $this->loadView('footer');
        } else {
            $this->loadView('login');
        }        
    }
    
    public function doLogin() {
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
}