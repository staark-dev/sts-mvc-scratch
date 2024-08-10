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

    private static array $routesMap;

    public static function get(string $url, mixed $callback, array &$params = []): void
    {
        self::dispatch($url, $callback);
    }

    public static function post(string $url, mixed $callback, array &$params = []): void
    {
        self::dispatch($url, $callback);
    }

    /**
     * @return void
     */
    public static function dispatch(string &$url, mixed &$callback): void
    {
        global $app;
        $params = $_SERVER['REQUEST_URI'];
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $url);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if($is_match) {
            array_shift($matches);

            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            if(is_array($callback)) {
                require "app/Controllers/{$callback[0]}.php";

                $controller = new $callback[0];
                if(!empty($callback[1]) && method_exists($controller, $callback[1])) {
                    $controller->action = $callback[1];
                }

                call_user_func_array([$controller, $controller->action], [new Request($params), new Response()]);
            }

            if(!is_array($callback))
                $callback(new Request($params), new Response());
        }
        /*
        $urlMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if ($is_match) {
            // first value is normally the route, lets remove it
            array_shift($matches);
            // Get the matches as parameters
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            $callback = self::$routesMap[$urlMethod][$url] ?? false;
            if(isset($callback))
                var_dump("Not Found this route");
                self::view('404');



            if(is_array($callback)) {
                require "app/Controllers/{$callback[0]}.php";

                $controller = new $callback[0];
                if(!empty($callback[1]) && method_exists($controller, $callback[1])) {
                    $controller->action = $callback[1];
                }

                call_user_func_array([$controller, $controller->action], [new Request($params), new Response()]);
            } else {
                $callback(new Request($params), new Response());
            }
        }*/
    }

    public function group(string $url, $callback, array $params = []): bool
    {
        return false;
    }

    /*public function get(string $url, $callback, array $params = []): void
    {
        self::$routesMap[self::METHOD_GET]['url'] = $url;
        $this->routes[self::METHOD_GET][$url] = $callback;
        $this->params[self::METHOD_GET][$url] = $params;
    }
    public function put(string $url, $callback, array $params = []): void
    {
        $this->routes[self::METHOD_PUT][$url] = $callback;
        //$this->params[self::METHOD_PUT][$url] = $params;
    }

    public function delete(string $url, $callback, array $params = []): void
    {
        $this->routes[self::METHOD_DELETE][$url] = $callback;
        //$this->params[self::METHOD_DELETE][$url] = $params;
    }

    public function post(string $url, $callback, array $params = []): void
    {
        $this->routes[self::METHOD_POST][$url] = $callback;
        //$this->params[self::METHOD_POST][$url] = $params;
    }*/
}