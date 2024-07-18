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
            "dbname"   => $_ENV["MYSQL_DATABASE"]
        ];
    }
}