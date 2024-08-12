<?php

use Http\Response;

/**
 * Class Name: Routes
 * @param Router::get('', 'string', $params)
 * @param Router::get('', [array], $params)
 * @param Router::post('', 'string', $params)
 * @param Router::post('', [array], $params)
 */

class Router {
    use Template;
    private static array $routesMap = [];

    /**
     * @throws exception
     */
    public function __construct() {
        global $request;
        
        if(!isset(self::$routesMap[$_SERVER['REQUEST_METHOD']][$request->getPath()]))
            $this->view('404');
    }

    /**
     * @throws exception
     */
    public static function get(string $url, mixed $callback, array &$params = []): void
    {
        self::dispatch($url, $callback);
    }

    /**
     * @throws exception
     */
    public static function post(string $url, mixed $callback, array &$params = []): void
    {
        self::dispatch($url, $callback);
    }

    /**
     * @throws exception
     */
    public static function dispatch(string &$url, mixed &$callback): void
    {
        global $request;
        global $response;

        $params = $_SERVER['REQUEST_URI'];
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $url);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if($is_match) {
            self::$routesMap[$_SERVER['REQUEST_METHOD']][$params] = $callback;
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

                call_user_func_array([$controller, $controller->action], [$request->getParams]);
            }

            if(!is_array($callback))
                $callback($request, new Response());
        }
    }

    public function group(string $url, $callback, array $params = []): bool
    {
        return false;
    }
}