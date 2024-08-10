<?php

Router::get('/', [HomeController::class, 'index']);
Router::get('/users', [UsersController::class, 'index']);

// Sign Up && Login
Router::get('/auth/login', [\Auth\AuthController::class, 'loginIndex']);
Router::post('/auth/login', [\Auth\AuthController::class, 'login']);
Router::get('/auth/signup', [\Auth\AuthController::class, 'signupIndex']);
Router::post('/auth/signup/save', [\Auth\AuthController::class, 'create']);
Router::get('/auth/([a-z A-Z]*)/profile', [\Auth\AuthController::class, 'profile']);
Router::get('/auth/sign-out', [\Auth\AuthController::class, 'sign_out']);
Router::get('/auth/accounts/([a-z A-Z]*)/([0-9]*)', [\Auth\AuthController::class, 'profile']);

Router::get('/test', callback: function(Http\Request $request, Http\Response $response){
    $response->view('welcome');
});

Router::get('/user/profile/([a-z A-Z]*)/([0-9]*)', function(Http\Request $request, Http\Response $response) {
    $response->view('user', $request->params);
});

/**
 * Dashboard Pages Soon
 */