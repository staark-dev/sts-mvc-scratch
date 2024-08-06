<?php

$app->routes->get('/', [HomeController::class, 'index']);
$app->routes->get('/users', [UsersController::class, 'index']);

// Sign Up && Login
$app->routes->get('/auth/login', [\Auth\LoginController::class, 'index']);
$app->routes->post('/auth/login', [\Auth\LoginController::class, 'save']);
$app->routes->get('/auth/accounts', [\Auth\AccountsController::class, 'index']);
$app->routes->post('/auth/accounts/save', [\Auth\AccountsController::class, 'create']);

// Other Routes
$app->routes->get('/test', function($app) {
    $app->view('welcome');
});

$app->routes->get('/auth/accounts/{(.*?)}/{\d+}', function($app) {
    $app->view('auth/accounts');
});

// Does't work for the moment ...
// Will fixed after 2 hours...
//$app->routes->get('/home', [HomeController::class, 'index']);