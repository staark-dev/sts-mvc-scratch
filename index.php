<?php
declare(strict_types=1);

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

Session::start(30, app('app', 'cache_path'), 'localhost', false);

$request = \Http\Request::createFromGlobals();
$kernel = new \Http\Kernel();
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
        'Database' => Database::class
    ], 'app/core/');

} catch (Exception $e) {
    echo "[STS Logs]: " . $e->getMessage();
}

/**
 * --------------------------------------------------
 * Run Applications
 * --------------------------------------------------
*/
$app->run($kernel, $request);