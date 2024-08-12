<?php
namespace Http;

class Kernel {
    public function handle(Request $request): Response
    {
        $content = '';

        return new Response($content);
    }
}