<?php
    class Controller {
        public string $viewPath;
        public string $cachePath;
        private string $file = 'config.ini';

        public function __construct(protected Template $template) {
            if (!$config = parse_ini_file(basename('/app') . "/config/" . $this->file, TRUE)) 
                throw new exception('Unable to open ' . $this->file . '.');

            $this->viewPath = $config['app']['views'] ?? basename('/app') . DIRECTORY_SEPARATOR . '/views';
            $this->cachePath = $config['app']['cache'];
            $this->template = new Template($this->viewPath, [], $this->cachePath);
        }

        /**
         * Load Views
         * @param string $view
         * @param array $data
        */
        public function view(string $tpl, array $data = []) {
            var_dump($this->viewPath);

            if (!$this->viewPath && !file_exists($this->viewPath . $tpl . '.php')) 
                throw new exception('Unable to open ' . $tpl . '.');

            $this->template->render($tpl, $data, $this->cachePath);
                /*
            if(is_array($data)) 
                extract($data);
            if(file_exists("app/views/" . $view . '.php'))
                require "app/views/" . $view . '.php';
                */
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