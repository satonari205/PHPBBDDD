<?php

namespace Framework;

class Response
{
    public function __construct(
        private mixed $content = "",
        private int $status = 200,
        private array $headers = []
    ) {
        header('Content-Type: application/json; charset=utf-8');
    }

    public function send(): void
    {
        echo json_encode($this->content);
    }
}
