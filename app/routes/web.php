<?php

$app->routes->get('/', [HomeController::class, 'index']);

$app->routes->get('/test', function($app) {
    $app->view('welcome');
});

$app->routes->get('/users', [UsersController::class, 'index']);

$app->routes->get('/auth/login', function($app) {
    $app->view('auth/login');
});

//$app->routes->get('/auth/accounts', function($app) {
//    $app->view('auth/accounts');
//});

$app->routes->get('/auth/accounts', [\Auth\AccountsController::class, 'index']);
$app->routes->post('/auth/accounts/save', [\Auth\AccountsController::class, 'create']);


$app->routes->get('/auth/accounts/{(.*?)}/{\d+}', function($app) {
    $app->view('auth/accounts');
});

// Does't work for the moment ...
// Will fixed after 2 hours...
//$app->routes->get('/home', [HomeController::class, 'index']);