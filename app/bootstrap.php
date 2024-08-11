<?php
// Autoload Configuration File
require_once 'config/config.php';
require_once 'Helpers/functions.php';

ini_set('output_buffering', 'true');

spl_autoload_register(function ($class) {
    require 'core/' . $class . '.php';
});