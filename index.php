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

require_once 'app/routes/web.php';
require_once 'app/routes/api.php';

$app = new App;

/**
 * --------------------------------------------------
 * Autoload Vendors
 * --------------------------------------------------
*/


/**
 * --------------------------------------------------
 * Run Applications
 * --------------------------------------------------
*/
try {
    $app->registerHandler([
        'Router' => Router::class,
        'Database' => Database::class
    ], 'app/core/');

    $response = $kernel->handle($request);
    $response->send();
} catch (Exception $e) {
    echo "[STS Logs]: " . $e->getMessage();
}

$app->run();