<?php

namespace Framework;

class Response
{
    private array $cookies;

    public function __construct(private mixed $content = "", private int $status = 200)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function send(): void
    {
        // レスポンスヘッダーを設定
        header('Content-Type: application/json; charset=utf-8');

        // クッキーを設定
        foreach ($this->cookies as $cookie) {
            setcookie(
                $cookie['name'],
                $cookie['value'],
                $cookie['expire'],
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
        }

        echo json_encode($this->content);
    }

    public function setTokenInCookie(string $name, string $value): void {
        $config = Config::getEnv();
        $this->cookies[$name] = [
            'name'     => $name,
            'value'    => $value,
            'expire'   => time() + $config['expire'],
            'path'     => $config['path'],
            'domain'   => $config['domain'],
            'secure'   => $config['secure'],
            'httponly' => $config['httponly'], 
        ];
    }
}
