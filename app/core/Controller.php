<?php
    class Controller {
        /**
         * Load Views
         * @param string $view
         * @param array $data
        */

        public function view(string $view, array $data = []) {
            if(is_array($data)) 
                extract($data);
            if(file_exists("app/views/" . $view . '.php'))
                require "app/views/" . $view . '.php';
        }

        /**
         * Load Model
         * @param string $model
         */
        public function model(string $model) {
            if(file_exists("app/models/" . ucfirst($model) . ".php")) {
                require "app/models/" . ucfirst($model) . ".php";
                return new $model();
            }
            
            return false;
        }
    }