<?php

// simple autoloader
// all namespace, classes must exists inside classes/ root directory.

spl_autoload_register(function ($class){
    $copy = str_replace('\\', '/', $class);
    $dir = '../classes/'; // base directory
    // get class name
    $className = basename($copy);

    // remove class
    $dir .= strtolower(rtrim($copy, $className));

    if (is_dir($dir))
    {
        $dir = strtolower(rtrim($dir, '/')) . '/' . strtolower($className) . '.php';
        
        if (file_exists(strtolower($dir)))
        {
            // include class
            include_once(strtolower($dir));
        }
        else
        {
            die("'{$className}' class doesn't exist.");
        }
    }
    else
    {
        die("{$dir} doesn't exits. So therefore we couldn't load class '$className'");
    }
});