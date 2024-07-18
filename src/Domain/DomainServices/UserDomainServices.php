<?php

namespace App\Domain\DomainServices;

use App\Models\User;
use App\Repositories\UserRepository;

class UserDomainService
{
    /* ユーザーがすでに存在しているか確認してBoolを返す */
    public function exists(User $user): bool
    {
        return (new UserRepository)->findByEmail($user->email) === null;
    }
}