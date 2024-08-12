<?php
namespace Http;

use Template;

class Response {
    use Template;
    public function __construct(
        private ?string $content = '',
        private int $status = 200,
        private array $headers = []
    ) {}

    public function send(): void
    {
        echo $this->content;
    }
}