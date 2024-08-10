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
        $this->model = null;

        if(method_exists($this, $this->action)) {
            $this->action = $this->request->getMethod();
        } else {
            $this->action = null;
        }

        /**
         * Autoload models for controllers
         * @param $model
         * @param $method
         * @param $middleware
         */
        $this->registerHandler([
            'Model' => get_called_class(),
            'Middleware' => null,
            'Method' => null
        ]);

        /**
         * Auto register model not work perfect
         *
         */
        /*$model = explode("\\", get_called_class());
        if(isset($model[1])) {
            $model[1] = str_replace(['Controller', 'sController'], "", $model[1]);
            $this->model = $this->loadModel($model[1]);
        } else {
            $model[0] = str_replace(['Controller', 'sController'], "", $model[0]);
            $this->model = $this->loadModel($model[0]);
        }*/
    }

    /**
     * @throws Exception
     */
    public function registerHandler(array $action = [], string $path = 'app/'): bool
    {
        foreach ($action as $actions => $method) {
            switch ($actions) {
                case 'Model':
                    $model = explode("\\", $method);

                    if(is_array($model)) {
                        if(isset($model[1])) {
                            $model[1] = str_replace('sController', "", $model[1]);
                            $model[1] = str_replace('Controller', "", $model[1]);
                            $model = $model[1];
                        } else {
                            $model[0] = str_replace(['sController', 'Controller'], "", $model[0]);
                            $model = $model[0];
                        }
                    }

                    $modelPath = "{$path}Models/{$model}.php";

                    if(!file_exists($modelPath))
                    {
                        $this->model = null;
                        return false;
                    } else {
                        require $modelPath;
                        $this->model = new $model();
                    }
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