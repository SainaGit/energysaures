<?php
namespace cdn;

class Request
{
    private $_domain;
    private $_httphost = '';
    private $_url = '';
    private $_url_clean = '';
    private $_app = '';
    private $_path = '';
    private $_secure = false;
    private $_method = 'GET';
    private $_script = '';
    
    function __construct() {
        $this->initFromGlobals();
    }
    
    public function getDomain() {
        return $this->_domain;
    }

    public function getHttpHost() {
        return $this->_httphost;
    }
    
    public function getUrl() {
        return $this->_url;
    }
    
    public function getCleanUrl() {
        return $this->_url_clean;
    }
    
    public function getApp() {
        return $this->_app;
    }
    
    public function setApp($app) {
        $this->_app = $app;
    }

    public function getPath() {
        return $this->_path;
    }
    
    public function isSecure() {
        return $this->_secure;
    }

    public function getMethod() {
        return $this->_method;
    }
    
    public function getScript() {
        return $this->_script;
    }

    public function getPathComplete() {
        return $this->_path . $this->_app;
    }

    protected function initFromGlobals() {
        $this->_domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $this->_script = $this->cleanDoubleSlash((isset($_SERVER['SCRIPT_NAME'])) ? $_SERVER['SCRIPT_NAME'] : '');
                
        if (isset($_SERVER['REQUEST_URI']))
            $url = $_SERVER['REQUEST_URI'];
        else {
            if (isset($_SERVER['REQUEST_URL']) && ! empty($_SERVER['REQUEST_URL']))
                $url = $_SERVER['REQUEST_URL'];
            else
                $url = '';
        }
        
        $url = trim($url);        
        $this->_url = $this->cleanDoubleSlash($url);
        $this->_url_clean = $this->cleanUrl($this->getUrl());
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['_method']) && (strtoupper($_POST['_method']) == 'PUT'
                    || strtoupper($_POST['_method']) == 'DELETE'))
                $this->_method = strtoupper($_POST['_method']);
            else
                $this->_method = 'POST';
        }
        
        if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            $this->_secure = true;
            $httphost = 'https';
        } else {
            $httphost = 'http';
        }
        $httphost .= '://'. $this->getDomain();
        $this->_httphost = $httphost;
        
        $path = str_replace(basename($this->getScript()), '', $this->getScript());
        $this->_path =$this->cleanDoubleSlash($path);
        
        define('_WEB_', $httphost . $path);
        define('_WEB_PUBLIC_', _WEB_ . DEF_PUBLIC . DS);
    }

    protected function cleanUrl($url) {
        $dir_name = dirname($this->getScript());
        
        if ($dir_name != DS)
            $url = str_replace($dir_name, '', $url);
        
        $query_string = strpos($url, '?');
        
        if ($query_string !== FALSE)
            $url = substr($url, 0, $query_string);
      
        if (substr($url, 1, strlen(basename($this->getScript()))) == basename($this->getScript()))
            $url = substr($url, strlen(basename($this->getScript())) + 1);
        
        $url = rtrim($url, DS) . DS;

        return $url;
    }

    public function forceCleanUrl($url) {
        $this->_url_clean = $url;
    }

    public function cleanDoubleSlash($in) {
        return preg_replace('/\/+/', '\\1/', $in);
    }
}