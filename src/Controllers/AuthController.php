<?php

namespace App\Controllers;

use App\ApplicationServices\AuthApplicationService;
use Framework\Request;
use Framework\Response;

class AuthController
{
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

    public function login()
    {
        //
    }

    public function logout()
    {
        //
    }
}
