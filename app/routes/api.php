<?php

use Http\{Request, Response};

Router::get('/api/login_signup/([a-zA-Z]+)', function(Request $request, Response $response) {
    // TODO: 
    $response->view('login_social', [
        'method' => $request->params[0],
        'data' => $request->params
    ]);
});

Router::get('/api/login_signup/([a-zA-Z]+)/callback', function(Request $request, Response $response) {
    // TODO: 
    $response->view('login_social', $request->params);
});