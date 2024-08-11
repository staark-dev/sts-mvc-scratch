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

    public function to(string $link) {
        if (headers_sent()) {
            die("Redirect failed. Please click on this link: <a href='$link'>redirect...</a>");
        }
        else {
            exit(header("Location: $link"));
        }
    }
}
?>