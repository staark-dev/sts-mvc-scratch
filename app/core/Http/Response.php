<?php
namespace Http;
use Http\Redirect;

class Response extends Redirect {
    public function statusCode(int $code)
    {
        http_response_code($code);
    }
}