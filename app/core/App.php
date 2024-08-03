<?php

    class App {
        private $controller = "Home";
        private $method;
        private $params;

        private function slitURL() {
            $url = $_GET['url'] ?? "Home";
            $url = explode('/', filter_var(trim($url, '/')), FILTER_SANITIZE_URL);
            return $url;
        }

        public function run() {
            $url = $this->slitURL();

            //var_dump($url);
            /**
             * Loading controller Files
             */
            $viewControllers = "app/controllers/" . ucfirst($url[0]) . '.php';

            if(!file_exists($viewControllers) && count($url) === 2) {
                $viewControllersPath = "app/controllers/" . ucfirst($url[0]) . '/' . ucfirst($url[1]) . '.php';
            }

            /**
             * 404 Page Not Found
             */
            $_404 = "app/controllers/_404.php";

            /**
             * Check controller type and pages.
             */
            if(!file_exists($viewControllers) && count($url) === 2) {
                require_once $viewControllersPath;
                $this->controller = ucfirst($url[1]);
                unset($url[0]);
                unset($url[1]);
            } elseif(!file_exists($viewControllers) && count($url) === 1) {
                require_once $_404;
                $this->controller = '_404';
                unset($url[0]);
            } elseif(file_exists($viewControllers) && count($url) === 1){
                require_once $viewControllers;
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }

            $controller = new $this->controller;

            /**
             * Check for method
             */

            if(!empty($url[1]) && method_exists($controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }

            /**
             * Class load and make url 
             */
            
            $this->params = (count($url) > 0) ? $url : ['home'];
            call_user_func_array([$controller, $this->method ?? 'index'], $this->params);
        }
    }