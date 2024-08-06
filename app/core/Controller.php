<?php
/**
 * Final Class Controller
 * @params
 */
use \Http\{Request, Response};

abstract class Controller {
    use Template;

    protected $model;
    public ?Request $request;
    public ?Response $response;

    
    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;

        /**
         * Autoload models for controllers
         * @param $model
         */
        $model = str_replace('sController', "", get_called_class());
        $this->model = $this->loadModel($model);

    }

    protected function loadModel(string $model) {
        $modelExists = "app/Models/{$model}.php";
        if(!file_exists($modelExists))
            return;
            //throw new Exception("This model [$model] doesn\\'t exists !");

        require_once $modelExists;
        $model = new $model();

        return $model;
    }
}