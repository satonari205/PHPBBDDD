<?php

namespace App\ApplicationServices;

use App\Domain\DomainServices\UserDomainService;
use App\Domain\Models\User;
use App\Repositories\UserRepository;


class AuthApplicationService
{
    public function authenticate(string $email, string $password): array
    {
        $result = [
            'success' => true,
            'message' => '',
            'user_id' => null,
        ];

        // メールでUserを検索
        $user = (new UserRepository)->findByEmail($email);

        // メールで引っかからなければユーザーがいないよって返す
        if ($user === null) {
            $result['suucess'] = false;
            $result['message'] = "User not found.";
            return $result;
        }

        // パスワードを照合して間違ってれば間違ってるよって返す
        if (!password_verify($password, $user->getPassword())) {
            $result['suucess'] = false;
            $result['message'] = "Password is incorrect.";
            return $result;
        }

        // メールもパスワードも正しいならuserIdを返す
        $result['user_id'] = $user->getId();

        return $result;
    }

    public function getUser()
    {
        //
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
