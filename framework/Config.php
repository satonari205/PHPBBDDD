<?php

namespace Framework;

class Config
{
    public static function getEnv(): array
    {
        return [
            "user"     => $_ENV["DB_USER"],
            "password" => $_ENV["DB_PASSWORD"],
            "host"     => $_ENV["HOST"],
            "dbname"   => $_ENV["DB_NAME"]
        ];
    }
}