<?php

class Controller {
    use Traits\Template;
    public string $modelName;
    protected $model;

    public function __construct() {
        $this->modelName = get_class($this) . 'Model';
        //$this->model(get_class($this) . 'Model');
        return $this;
    }

    /**
     * Load Model
     * @param string $model
     */
    public function model(string $model) {
        if(file_exists("app/models/" . ucfirst($model) . ".php")) {
            require_once "app/models/" . ucfirst($model) . ".php";
            return new $model();
        }
        
        return false;
    }
}