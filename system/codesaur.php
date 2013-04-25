<?php
defined('CODESAUR') || define('CODESAUR', str_replace('\\', '/', dirname(__FILE__)) . "/");

class codesaur
{
    private static $_instance;

    public static function start($userdef = NULL) {
        if (file_exists(CODESAUR . 'common.php'))
            require(CODESAUR . 'common.php');
        else
            self::end(CODESAUR . 'common.php is missing!');
        
        if ($userdef !== NULL) {
            $userdef .= '.php';
            require_code($userdef);
        }
        
        require_code(CODESAUR . 'defaults.php');
        
        self::setEnvironment();
        self::setAliases($userdef);
        
        return new cdn\WebApplication($userdef);
    }
    
    public static function setInstance($instance)
    {
        self::$_instance = $instance;
    }
    
    public static function instance()
    {
        return self::$_instance;
    }
    
    public static function setEnvironment() {
        define('INDEX_PATH', str_replace('\\', DS, dirname($_SERVER['SCRIPT_FILENAME'])));
                
        error_reporting(E_ALL);
        ini_set('display_errors', (defined('DEVELOPMENT')) ? "On" : "Off");
        
        if (defined('ERROR_LOG')) {
            ini_set('log_errors', "On");
            ini_set('error_log', INDEX_PATH . DS . DEF_TEMP . DS . DIR_LOG . DS . ERROR_LOG);
        }
    }

    public static function setAliases($userdef) {        
        $system_path = find_dir(CODESAUR, INDEX_PATH);
        if ( ! $system_path)
            codesaur::end("System folder path does not appear to be set correctly!");
        
        if ($userdef !== NULL) {
            $userdef_path = realpath($userdef);
            if (strlen(INDEX_PATH) === strlen(dirname($userdef_path)))
                $userdef = NULL;
        }

        $app_path = ($userdef === NULL) ? realpath(DEF_APP) : $userdef_path;
        $app_path = find_dir($app_path, INDEX_PATH);
        if ( ! $app_path)
            codesaur::end("Application folder path does not appear to be set correctly!");
        
        $app_path .= DS;
        
        define('SYSTEM_PATH', INDEX_PATH . DS . $system_path);
        define('APP_PATH', INDEX_PATH . DS . $app_path);
        
        if (defined('USE_ABSOLUTE_PATHS')) {
            $system_path = SYSTEM_PATH;
            $app_path = APP_PATH;
        }
        
        define('_BASE_', $system_path . DEF_BASE . DS);
        define('_FRONTEND_', defined('DEF_FRONTEND') ? ($app_path . DEF_FRONTEND . DS) : $app_path);
        define('_BACKEND_',  $app_path . DEF_BACKEND . DS);
        define('_COMMON_',  $app_path . DEF_COMMON . DS);
        define('_PUBLIC_', INDEX_PATH . DS . DEF_PUBLIC . DS);
        
        require_dir(_BASE_);
        require_dir(_FRONTEND_);
        
        if (! defined('NO_BACKEND'))
            require_dir(_BACKEND_);
    }
    
    public static function end($msg) {
        echo '<!DOCTYPE html>' . PHP_EOL;
        echo '<html lang="en-us">' . PHP_EOL;
        echo '<head>' . PHP_EOL;
        echo '</head>' . PHP_EOL;
        echo '<body>' . PHP_EOL;
        echo '<h1>404 Error</h1>' . PHP_EOL;
        echo '<p>Looks like this page doesn\'t exist</p>' . PHP_EOL;
        echo '<hr>' . PHP_EOL;
        
        if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
            $hosted = 'https://';
        else
            $hosted = 'http://';
        $hosted .= (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '/';
        
        echo '<a href="' . $hosted . '">' . $hosted . '</a>' . PHP_EOL;
        
        if (defined('DEVELOPMENT')) {
            echo "<hr>" . PHP_EOL;
            echo "<strong>Development error:</strong> $msg<br/>" . PHP_EOL;
        }
        echo '</body>' . PHP_EOL;
        echo '</html>';

        exit(1);
    }
}