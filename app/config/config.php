<?php 

function baseurl() {
    return 'http://127.0.2.36';
}

function navbar() {
    return 'STS CMR';
}

function app(mixed $key, mixed $vars = false, string $file = 'config.ini') {
    if (!$config = parse_ini_file(basename('/app') . "/config/" . $file, TRUE)) 
        throw new exception('Unable to open ' . $file . '.');

    return $config[$key][$vars] ?? null;
}