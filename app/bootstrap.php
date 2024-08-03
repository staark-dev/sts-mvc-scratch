<?php
// Autoload Configuration File
require_once 'config/config.php';

// Autoload Core Libraries
spl_autoload_register(function($class_load) {
    require_once 'core/' . $class_load . '.php';
});