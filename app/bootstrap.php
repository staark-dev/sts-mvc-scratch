<?php
declare(strict_types=1);

// Autoload Configuration File
require_once 'config/config.php';
require_once 'Helpers/functions.php';

spl_autoload_register(function ($class) {
    require 'core/' . $class . '.php';
});
