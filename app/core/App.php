<?php

use Http\{Request, Response};

class App {
    use Template;
    public ?Request  $request;
    public ?Response $response;

    public function __construct() {
        $this->request = new Request;
        $this->response = new Response;
    }

    /**
     * @throws Exception
     */
    public function registerHandler(array $action = [], $path = 'app'): mixed
    {
        foreach ($action as $actions => $method) {
            switch ($actions) {
                case "{$actions}":
                    $file = "{$path}{$actions}.php";
                    if (!file_exists($file)) {
                        throw new \Exception('The requested file (' . $file . ') does not exist, or has been deleted.');
                    }

                    if(is_array($method)) {
                        $handler = new $method[0];
                        $handlerMethod = $method[1];

                        if(method_exists($handler, $handlerMethod)) {
                            call_user_func_array([$handler, $handlerMethod], []);
                        } else throw new \Exception('Unexpected method call');
                    } else {
                        return new $method;
                        //call_user_func($handler);
                    }

                    break;

                default:
                    throw new \Exception('Unexpected value');
            }
        }

        return false;
    }

    public function run(): void
    {
        require_once 'app/routes/web.php';
        require_once 'app/routes/api.php';
    }
}