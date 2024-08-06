<?php

use Http\Request;

class App {
    use Template;
    
    public ?Router $routes;
    public ?Request $request;

    public function __construct()
    {
        $this->request = new Request;
        $this->routes = new Router($this->request);
    }

    public function run() {
        $this->routes->resolve();
    }
}