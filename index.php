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
require_once 'app/routes/web.php';

/**
 * --------------------------------------------------
 * Run Applications
 * --------------------------------------------------
*/
$app->run();