<?php

/**
 * --------------------------------------------------
 * Create Instance of Applications
 * --------------------------------------------------
*/
require_once 'app/bootstrap.php';
require_once 'app/routes/web.php';
require_once 'app/routes/api.php';
/**
 * --------------------------------------------------
 * Start sessions
 * --------------------------------------------------
*/
//_Sessions::init();

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
        'Session' => SessionHandler::class,
        'Database' => Database::class
    ], 'app/core/');
} catch (Exception $e) {
    //echo "This is error from class App: " . $e->getMessage();
}
/**
 * --------------------------------------------------
 * Run Applications
 * --------------------------------------------------
*/
$app->run();