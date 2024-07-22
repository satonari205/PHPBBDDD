<?php

namespace App\ApplicationServices;

use App\Domain\Models\Thread;
use App\Repositories\UserRepository;
use App\Repositories\ThreadRepository;
use App\Traits\ResponseTrait;
use InvalidArgumentException;


class ThreadApplicationService
{
    use ResponseTrait;

    public function getThread(int $id)
    {
        $thread = (new ThreadRepository)->find($id);

        if ($thread === null) {
            return $this->failResponse(404, 'BBS cannot get the thread.');
        }

        $user = (new UserRepository)->findById($thread->getUserId());

        return $this->getThreadArray($thread, $user);
    }

    public function getThreads(array $params): array
    {
        $threads = (new ThreadRepository)->all(
            $params['page'],
            $params['page_size'],
            $params['sort'],
            $params['order'],
            $params['search']
        );

        // Nullの時は空配列を返す
        if($threads === null){
            return [];
        }

        // ユーザーを取得して結合
        $res = (array) array_map(function ($thread) {
            $thread['user'] = (new UserRepository)->findById($thread->getUserId());
            return $thread;
        }, $threads);

        // Modelを全て配列にして返す
        return (array) array_map(function ($thread) {
            return $this->getThreadArray($thread, $thread['user']);
        }, $res);
    }

    public function createThread(int $userId, string $title, string $body)
    {
        try {
            $thread = new Thread($userId, $title, $body);

            if((new ThreadRepository)->save($thread) === null){
                return $this->failResponse(400, "store failed.");
            }

            $user = (new UserRepository)->findById($userId);

            return $this->getThreadArray($thread, $user);
        } catch (InvalidArgumentException $e) {
            return $this->failResponse(400, $e->getMessage());
        }
    }

    public function updateThread(int $id, string $title, string $body): array
    {
        $thread = (new ThreadRepository)->find($id);

        if ($thread === null) {
            return $this->failResponse(404, 'BBS cannot get the thread.');
        }

        $newThread = (new ThreadRepository)->update($thread->setTitle($title)->setBody($body));
        $user = (new UserRepository)->findById($newThread->getUserId());

        return $this->getThreadArray($newThread, $user);
    }

    public function deleteThread(int $id): array
    {
        $res = (new ThreadRepository)->delete($id);

        if($res === false){
            return $this->failResponse(400, "fail to delete.");
        }

        return $this->successResponse(200, "delete successful!");
    }
}