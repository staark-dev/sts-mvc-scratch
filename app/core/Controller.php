<?php
/**
 * Final Class Controller
 * @params
 */
use \Http\{Request, Response};

abstract class Controller {
    use Template;

    protected mixed $model = null;
    protected mixed $middleware = null;
    protected mixed $method = null;
    public ?Request $request;
    public ?Response $response;
    public mixed $action = 'index';


    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;

        if(method_exists($this, $this->action)) {
            $this->action = $this->request->getMethod();
        } else {
            $this->action = null;
        }

        $getModelPath = str_replace('sController', "", get_called_class());

        /**
         * Autoload models for controllers
         * @param $model
         * @param $method
         * @param $middleware
         */
        $this->registerHandler([
            'Model' => $getModelPath,
            'Middleware' => null,
            'Method' => null
        ]);
    }

    /**
     * @throws Exception
     */
    public function registerHandler(array $action = [], string $path = 'app/'): bool
    {
        foreach ($action as $actions => $method) {
            switch ($actions) {
                case 'Model':
                    if(!file_exists("{$path}Models/{$method}.php"))
                    {
                        $this->model = null;
                        return false;
                    }

                    require $m = "{$path}Models/{$method}.php";
                    $this->model = new $method();
                    break;

                case 'Method':
                    if(method_exists($actions, $method))
                        call_user_func($method);
                    break;

                case 'Middleware':
                    return false;
                    break;

                default:
                    throw new \Exception('Unexpected value');
            }
        }
        return false;
    }

    /**
     * @param string $model
     * @return mixed
     * @throws Exception
     */
    protected function loadModel(string $model): mixed
    {
        $modelExists = "app/Models/{$model}.php";
        if(!file_exists($modelExists))
            throw new Exception("This model [$model] doesn\\'t exists !");

        require_once $modelExists;
        $model = new $model();
        return $model;
    }
}