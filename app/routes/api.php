<?php
Router::get('/api/login_signup/([a-zA-Z]+)', function($request, $response) {
    $response->send('login_social', [
        'method' => $request->getParams['url'] ,
        'data' => $request->getParams
    ]);
});

Router::get('/api/login_signup/([a-zA-Z]+)/callback', function($request, $response) {
    $response->view('login_social', $request->params);
});