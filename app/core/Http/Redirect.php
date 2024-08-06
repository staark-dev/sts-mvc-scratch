<?php
namespace Http;

class Redirect {
    public function to(string $url) {
        header("Location: " .baseurl() . "/" . $url);
    }

    public function back() {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}