<?php

Router::get('/', [HomeController::class, 'index']);
Router::get('/users', [UsersController::class, 'index']);

// Sign Up && Login
Router::get('/auth/login', [\Auth\LoginController::class, 'index']);
Router::post('/auth/login', [\Auth\LoginController::class, 'save']);
Router::get('/auth/accounts', [\Auth\AccountsController::class, 'index']);
Router::post('/auth/accounts/save', [\Auth\AccountsController::class, 'create']);

Router::get('/test', callback: function(Http\Request $request, Http\Response $response){
    $response->view('welcome');
});

Router::get('/auth/accounts/([a-z A-Z]*)/([0-9]*)', function(Http\Request $request, Http\Response $response) {
    //var_dump($request->params);
    $response->view('user', $request->params);
});

Router::get('/user/accounts/([a-z A-Z]*)/([0-9]*)', function(Http\Request $request, Http\Response $response) {
    //var_dump($request->params);
    $response->view('user', $request->params);
});