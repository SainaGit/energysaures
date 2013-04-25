<?php
namespace cdn;

defined('CODESAUR') || exit(1);

class WebApplication extends Application
{
    public $controller = NULL;
    public $response = NULL;
    public $auth = NULL;
    
    public function web() {
        $this->auth = new Authentication($this->session);
        
        if ($this->isBackend($this->request->getCleanUrl())) {
            define('_APP_', _BACKEND_);
            $url = DS . substr($this->request->getCleanUrl(), strlen(ROUTE_BACKEND));
            $this->request->forceCleanUrl($url);
            $this->request->setApp(ltrim(ROUTE_BACKEND, DS));
        } else
            define('_APP_', _FRONTEND_);
        
        $rules = require_config(RULES_CFG);
        
        foreach ($rules as $rule)
            $this->router->mapArray($rule);
        
        $route = $this->router->matchRequest();
        
        if ( ! $route)
            return $this->try404('no route!');
        
        if ($this->controller = $this->loadController($route->getController())) {
            if (method_exists($this->controller, $route->getAction()))
                $result = call_user_func_array(array($this->controller, $route->getAction()), $route->getParameters());
            else {
                if (STRICT_ACTION)
                    return $this->try404("method named {{$route->getAction()}} is not part of object {{$route->getController()}}!");
                else
                    $result = call_user_func_array(array($this->controller, DEFAULT_ACTION), $route->getParameters());
            }
        }
        else
            return $this->try404("controller {{$route->getController()}} is not available!");
            
        return $result;
    }
    
    private function loadController($controller_name) {
        $controller_class = $controller_name . SUFFIX_CONTROLLER;

        if (class_exists($controller_class) === TRUE)
            return new $controller_class();
        
        return FALSE;
    }
    
    protected function try404($msg) {
        $error404_controller = $this->loadController('Error');
        
        if ($error404_controller)
            if (method_exists($error404_controller, 'error404'))
                return call_user_func_array(array($error404_controller, 'error404'), array('error' => $msg));
            
        \codesaur::end($msg);
    }
}