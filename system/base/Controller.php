<?php
namespace cdn;

defined('CODESAUR') || exit(1);

abstract class Controller
{
    public $model = NULL;
    
    public function index() {
    }
    
    public function loadModel($model_name) {
        $model_class = $model_name . SUFFIX_MODEL;
        
        if (class_exists($model_class) === TRUE)
            $this->model = new $model_class();
        
        return FALSE;

    }
    
    public function loadView($view_name, $path = _APP_) {
        $view_file = $path . DIR_VIEW . DS . $view_name . EXT;

        if (file_exists($view_file) === TRUE)
            require $view_file;
        else
            \codesaur::end("$view_file is missing!");
        
        return FALSE;
    }

    public function printMetaToHtml($metakey) {
        echo '<meta name="' . $metakey . '" content="' . $web[$metakey] . '">' . PHP_EOL;
    }
    
    public function incScriptsToHtml(array $script_list, $include_path = _WEB_PUBLIC_) {
        foreach ($script_list as $script)
            echo '<script src="' . $include_path . $script . '"></script>' . PHP_EOL;
    }
    
    public function incStylesToHtml(array $style_list, $include_path = _WEB_PUBLIC_) {
        foreach ($style_list as $style)
            echo '<link rel="stylesheet" href="' . $include_path . $style . '">' . PHP_EOL;
    }
    
    public function HtmlEndOfLine() {
        echo PHP_EOL;
    }
}