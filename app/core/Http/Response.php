<?php
namespace Http;
use Http\Redirect;

class Response extends Redirect {
    use \Template;

    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function back() {
        header("Location: /");
    }
}