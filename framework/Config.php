<?php

namespace Framework;

class Config
{
    public static function getEnv(): array
    {
        return [
            "user"     => $_ENV["MYSQL_USER"],
            "password" => $_ENV["MYSQL_PASSWORD"],
            "host"     => $_ENV["HOST"],
            "port"     => $_ENV["PORT"],
            "dbname"   => $_ENV["MYSQL_DATABASE"]
        ];
    }
}