<?php
// Autoload Configuration File
require_once 'config/config.php';

// Autoload Core Libraries
spl_autoload_register(function($class_load) {
    // Loading traits 
    require 'core/Traits/' . $class_load . '.php';

    // Load Controllers
    require 'core/Controllers' . $class_load . '.php';

    // Load Models
    require 'core/Models' . $class_load . '.php';
});