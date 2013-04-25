<?php
namespace cdn;

defined('CODESAUR') || exit(1);

abstract class Application
{
    public $session = NULL;
    public $request = NULL;
    public $router = NULL;
    
    function __construct($userdef) {
        \codesaur::setInstance($this);
        
        $this->session = new Session();
        $this->request = new Request();
        $this->router = new Router();
    }
    
    public function isBackend($url_clean = '') {
        if (defined('NO_BACKEND'))
            return FALSE;
        
        if (defined('_APP_'))
            return (_APP_ === _BACKEND_);
        
        if (strlen($url_clean) >= strlen(ROUTE_BACKEND)) {
            if (strtolower(substr($url_clean, 0, strlen(ROUTE_BACKEND))) === strtolower(ROUTE_BACKEND))
                return TRUE;
        }
        return FALSE;
    }
}