<?php
defined('CODESAUR') || exit(1);

function __autoload($class)
{
    if (strpos($class, '\\'))
        $cdn_class_parts = explode('\\', $class);

    if (isset($cdn_class_parts[1])) {
        $path_name = _BASE_ . end($cdn_class_parts) . EXT;
        require_code($path_name);
    } else {
        if (deter_class($class))
            load_class($class);
    }
}

function deter_class(&$class)
{
    $class_name = str_replace(SUFFIX_CONTROLLER, '', $class);
    if ($class_name != $class) {
        $class = DIR_CONTROLLER . DS . $class_name;
        return 1;
    }

    $class_name = str_replace(SUFFIX_MODEL, '', $class);
    if ($class_name != $class) {
        $class = DIR_MODEL . DS . $class_name;
        return 2;
    }
    
    $class_name = str_replace(SUFFIX_VIEW, '', $class);
    if ($class_name != $class) {
        $class = DIR_VIEW . DS . $class_name;
        return 3;
    }
    
    return FALSE;
}

function load_class($class)
{
    $full_path = _APP_ . $class . EXT;
    
    if (file_exists($full_path))
        require($full_path);
    else {
        $full_path = _COMMON_ . $class . EXT;
        if (file_exists($full_path))
            require($full_path);
    }
    
    return FALSE;
}

function find_dir($search_path, $root_path)
{
    if ($search_path == '')
        return FALSE;
    
    $search_path = str_replace('\\', DS, $search_path);
    $root_path = str_replace('\\', DS, $root_path);
    
    while ($root_path < $search_path) {
        $dir_found = $search_path;
        $search_path = dirname($search_path);
    }
    
    if ( ! isset($dir_found))
        return FALSE;
    
    $dir_found = ltrim(str_replace($root_path, '', $dir_found), DS);
    
    return $dir_found;
}

function require_dir($dir)
{
    if ( ! is_dir($dir))
        codesaur::end("$dir folder path is not available!");
}

function require_code($phpfile)
{
    if (file_exists($phpfile))
        return require($phpfile);
    
    codesaur::end("$phpfile is missing!");
}

function require_config($config_name, $path = _APP_)
{
    return require_code($path . DIR_CONFIG . DS . $config_name . EXT);
}

function debug_echo($var, $with_comma = false)
{
    if (!defined('DEVELOPMENT'))
        return;
    
    if (is_array($var))
        print_r($var);
    else
        echo $var;
}

function debug_dump($var)
{
    if (defined('DEVELOPMENT'))
        var_dump($var);
}