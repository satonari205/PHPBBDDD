<?php

namespace App\ApplicationServices;

use App\Repositories\UserRepository;

class UserApplicationService
{
    public function getUser(int $id)
    {
        $userArray = (new UserRepository)->findById($id);
    }
}