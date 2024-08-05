<?php
// Autoload Configuration File
require_once 'config/config.php';
session_start();

function auto_load_files(string $class, array $dirs) : void {
    $class_name = substr($class, strrpos ($class, "\\"));
    foreach ($dirs as $dir) {
        $classes = "$dir/".ucfirst($class_name).".php";
        //var_dump("Scanned dir: {$dir} = "); var_dump(file_exists($classes));
        if (file_exists($classes)) {
            require_once $classes;
            var_dump($classes . " was Loaded");
        }
    }
}

spl_autoload_register(function ($class) {
        $data = [
            "Models",
            "Controllers",
            "Helpers"
        ];

        auto_load_files($class, $data);
        require 'core/' . $class . '.php';
});
/*
spl_autoload_register(function($class_name) {

});*/