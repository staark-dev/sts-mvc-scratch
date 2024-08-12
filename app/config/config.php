<?php 
declare(strict_types=1);

define('APP_PATH', dirname(__DIR__));
define('CORE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR .'core' . DIRECTORY_SEPARATOR);

function baseurl() {
    return 'http://127.0.2.36';
}

function home_url() {
    return 'http://127.0.2.36';
}

function navbar() {
    return 'STS CMR';
}

function app(mixed $key, mixed $vars = false, string $file = 'config.ini') {
    if (!$config = parse_ini_file(APP_PATH . "/config/" . $file, TRUE)) 
        throw new exception('Unable to open ' . $file . '.');

    return $config[$key][$vars] ?? null;
}

function getCurrentUrl($full = true) {
    if (isset($_SERVER['REQUEST_URI'])) {
        $parse = parse_url(
            (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'off') ? 'https://' : 'http://') .
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '')) . (($full) ? $_SERVER['REQUEST_URI'] : null)
        );
        $parse['port'] = $_SERVER["SERVER_PORT"]; // Setup protocol for sure (80 is default)
        return $parse;
    }
}

