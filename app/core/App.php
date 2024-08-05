<?php

    class App {
        private string $controller = "Home";
        private string $method = "index";
        private mixed $params;

        private function slitURL() {
            $url = $_GET['url'] ?? "Home";
            $url = explode('/', filter_var(trim($url, '/')), FILTER_SANITIZE_URL);
            return $url;
        }

        public function run() {
            $url = $this->slitURL();

            $ext = "Controller";
            /**
             * Loading controller Files
             */
            $viewControllers = "app/Controllers/" . ucfirst($url[0]) . $ext . '.php';

            if(count($url) >= 2)
            {
                var_dump($url);
                $viewControllersPath = "app/Controllers/" . ucfirst($url[0]) . '/' . ucfirst($url[1]) . '.php';
            }
                

            /**
             * 404 Page Not Found
             */
            $_404 = "app/Controllers/_404.php";

            if(file_exists($viewControllers)) {
                require_once $viewControllers;
                $this->controller = ucfirst($url[0] . $ext);
                unset($url[0]);
            }

            if(count($url) >= 2 && file_exists($viewControllersPath)) {
                require_once $viewControllersPath;
                $this->controller = ucfirst($url[0]) . '/' . ucfirst($url[1]);
                unset($url[0]);
                unset($url[1]);
            }

            if(!file_exists($viewControllers) && !file_exists($viewControllersPath))
            {
                require_once $_404;
                $this->controller = $_404;
                unset($url);
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
            
            $this->params = (count($url) > 0) ? $url : [];
            call_user_func_array([$controller, $this->method ?? 'index'], $this->params);
        }
    }