<?php

namespace App\ApplicationServices;

use App\Domain\Models\Thread;
use App\Domain\Models\User;
use App\Repositories\UserRepository;
use App\Repostories\ThreadRepository;
use App\Traits\ResponseTrait;
use InvalidArgumentException;

class ThreadApplicationService
{
    use ResponseTrait;

    public function createThread($userId, $title, $body)
    {
        try {
            $thread = new Thread($userId, $title, $body);
        } catch (InvalidArgumentException $e) {
            return $this->failResponse(400, $e->getMessage());
        }

        $thread = (new ThreadRepository)->save($thread);
        $user = (new UserRepository)->findByEmail($thread->getId());

        return $this->getThreadArray($thread, $user);
    }
}
