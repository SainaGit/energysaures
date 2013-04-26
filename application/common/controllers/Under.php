<?php
defined('CODESAUR') || exit(1);

use cdn\Controller;

class UnderController extends Controller
{
    public $email_from;
    public $email_message;
    public $isEmailForm = false;
    public $config;
    
    function __construct() {
        $this->config = require_config('underconf', _COMMON_);
    }
    
    public function index() {
        $this->loadView('under', _COMMON_);
    }
    
    public function failure($error) {
        echo "</head><body>" . $this->config['error_line1'] . "<br />";
        echo $this->config['error_line2'] . "<br /><br />";
        echo $error."<br /><br />";
        echo $this->config['error_line3'] . "</body></html>";
        debug_echo("<hr>underconstruction feedback email error.");
        exit(1);
    }
    
    function cleanString($string) {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    public function emailForm() {
        $this->isEmailForm = true;
        $this->loadView('under', _COMMON_);

        if(isset($_POST['email'])) {
            $this->email_from = $_POST['email'];
        } else {
            $this->failure($this->config['no_email']);
        }
        
        $error_message = "";
        $email_exp = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
        if( ! preg_match($email_exp, $this->email_from)) {
            $error_message .= $this->config['invalid_email'];
        }
        
        if(strlen($error_message) > 0) {
            $this->failure($error_message);
        }
        
	if (isset($_POST['message']))
            $this->email_message = $_POST['message'];
        else
            $this->failure($this->config['no_message']);
        
        if ($this->email_message === $this->config['message'])
            $this->failure($this->config['no_message']);
            
        $this->email_message .= "\n"."\n"."Email: " . $this->cleanString($this->email_from) . "\n";
        
        $this->headers =    'From: '.$this->email_from."\r\n".
                            'Reply-To: '.$this->email_from."\r\n" .
                            'X-Mailer: PHP/' . phpversion();
        
        if (mail($this->config['mail_to'], $this->config['mail_subject'], $this->email_message, $this->headers))
            $this->success();
    }
    
    function success() {
        echo "</head><body>" . $this->config['success'] . "</body></html>";
    }
}