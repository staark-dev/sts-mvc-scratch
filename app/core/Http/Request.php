<?php
namespace Http;

class Request {
    public array $params = [];

    public function __construct($params = []) {
        $this->params = $params;
    }

    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if(!$position)
            return $path;

        return substr($path, 0, $position);
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function getBodyData(): array
    {
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $this->params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $this->params;
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $this->params[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $this->params;
    }
}