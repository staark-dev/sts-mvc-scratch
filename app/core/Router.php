<?php

/**
 * Class Name: Routes
 * @param Router::get('', 'string', $params)
 * @param Router::get('', [array], $params)
 * @param Router::post('', 'string', $params)
 * @param Router::post('', [array], $params)
 */
use Http\{Response, Request};


class Router {
    use Template;

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    public ?Request $request;
    public ?Response $response;
    protected $routes = [];
    protected $params = [];

    public function __construct(Request $request)
    {
        global $app;
        $this->request = $request;
        $this->response = new Response;
    }

    public static function __callStatic( $method, $params ) {
        return;
    }

    public function __call($method, $args) {
        if (method_exists($this, $method)) {
            return call_user_func_array( array($this, $method), $args);
        }
    }

    public function get(string $url, $callback, array $params = []){
        $this->routes['get'][$url] = $callback;
        $this->params = $params;
    }

    public function put(string $url, $callback, array $params = []){
        $this->routes['put'][$url] = $callback;
    }

    public function delete(string $url, $callback, array $params = []){
        $this->routes['delete'][$url] = $callback;
    }

    public function post(string $url, $callback, array $params = []){
        $this->routes['post'][$url] = $callback;
    }

    public function resolve() {
        global $app;
        $url = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$url] ?? false;

        if($callback === false)
            return $this->view('404');

        if(is_string($callback))
            return $this->view($callback);

        if(!is_array($callback))
            return call_user_func($callback, $app);

        /**
         * Call Controller Class
         * @param Controller::class
         * @param Controller::method
         */
        if(is_array($callback)) {
            require_once 'app/Controllers/' . $callback[0] . '.php';
            $controller = new $callback[0];
            $controllerMethod = $callback[1] ?? 'index';

            if(!empty($controllerMethod) && method_exists($controller, $controllerMethod)) {
                $controllerMethod = $callback[1];
            }

            call_user_func_array([$controller, $controllerMethod], [$this->request, $this->response]);
        }
    }
}