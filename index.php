<?php

/**
 * --------------------------------------------------
 * Create Instance of Applications
 * --------------------------------------------------
*/
require_once 'app/bootstrap.php';

/**
 * --------------------------------------------------
 * Start sessions
 * --------------------------------------------------
*/

/**
 * --------------------------------------------------
 * Create Instance of Applications
 * --------------------------------------------------
*/
$app = new App;

/**
 * --------------------------------------------------
 * Autoload Vendors
 * --------------------------------------------------
*/

try {
    $app->registerHandler([
        'Router' => Router::class,
        'Session' => Sessions::class,
        'Database' => Database::class,
        'Helpers' => ['functions', 'constants']
    ], 'app/core/');
} catch (Exception $e) {
    echo "[STS Logs]: " . $e->getMessage();
}

/**
 * --------------------------------------------------
 * Run Applications
 * --------------------------------------------------
*/

$app->run();