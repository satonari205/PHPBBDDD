<?php

namespace App\Controllers;

use App\ApplicationServices\AuthApplicationService;
use Framework\Config;
use Framework\Request;
use Framework\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class AuthController
{
    private $jwtKey;

    public function __construct()
    {
        $config = Config::getEnv();
        $this->jwtKey = $config['jwt_key'];
    }

    public function register(Request $request): Response
    {
        $params = $request->getPostParams();
        $res = (new AuthApplicationService)->createUser(
            $params['name'],
            $params['email'],
            $params['password'],
        );
        return new Response($res);
    }

    public function login(Request $request): Response
    {
        session_start();

        $params = $request->getPostParams();

        $result = (new AuthApplicationService)->authenticate($params['email'], $params['password']);

        if($result['success'] === false){
            return new Response($result['message']);
        }

        // セッションに認証用のトークン、CSRFトークンをそれぞれセット
        $jwt = $this->generateToken($result['user_id']);
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION['jwt'] = $jwt;
        $_SESSION['csrf_token'] = $csrfToken;

        // Cookieにそれぞれのトークンをセット
        $res = new Response("Login successful!");
        $res->setTokenInCookie('jwt', $jwt);
        $res->setTokenInCookie('csrf_token', $csrfToken);

        return $res;
    }

    public function user(Request $request)
    {
        $jwt = $request->getCookie('jwt');
        $csrfToken = $request->getCookie('csrf_token');

        $decoded = JWT::decode($jwt, new Key($this->jwtKey, 'HS256'));
        // $user = (new AuthApplicationService)->getUser();
        var_dump($decoded, $csrfToken);
    }

    public function logout()
    {
        session_start();
    }

    private function generateToken(string $userId)
    {
        $payload = [
            'iss' => $this->jwtKey,
            'user_id' => $userId,
            'iat' => time(),
            'exp' => time() + 3600
        ];
        return JWT::encode($payload, $this->jwtKey, 'HS256');
    }

    private function verifyToken()
    {
        //
    }
}
