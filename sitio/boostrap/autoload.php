<?php
spl_autoload_register(function ($classname){
    $filepath = __DIR__ . '/../clases/' . $classname . '.php';
    if(file_exists($filepath)) {
        require_once $filepath;
    }
});