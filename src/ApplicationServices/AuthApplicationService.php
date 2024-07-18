<?php

namespace App\ApplicationServices;

use App\Domain\DomainServices\UserDomainService;
use App\Domain\Models\User;
use App\Repositories\UserRepository;
use Firebase\JWT\JWT;


class AuthApplicationService
{
    private $jwtKey;

    public function __construct()
    {
        $this->jwtKey = $_ENV['JWT_SECRET_KEY'];
    }

    public function generateToken($user)
    {
        $payload = [
            'iss' => 'your-website.com',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 3600
        ];

        return JWT::encode($payload, $this->jwtKey, 'HS256');
    }

    public function createUser(string $name, string $email, string $password): string
    {
        $user = new User($name, $email, $password);

        // ユーザーがすでに登録されていないか確認
        if ((new UserDomainService)->exists($user)) {
            return "User has already registered.";
        }

        (new UserRepository)->create($user);

        return "User registration successful!";
    }
}