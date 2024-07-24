<?php

namespace ApplicationServices;

use App\Domain\Models\Comment;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;

class CommentApplicationService
{
    use ResponseTrait;

    public function getComments(int $threadId): array
    {
        $comments = (new CommentRepository)->list($threadId);

        return (array) array_map(function ($comment) {
            $user = (new UserRepository)->findById($comment->getUserId());
            $this->getCommentArray($comment, $user);
        }, $comments);
    }

    public function getComment(int $id): array
    {
        $comment = (new CommentRepository)->find($id);
        $user = (new UserRepository)->findById($comment->getUserId());

        return $this->getCommentArray($comment, $user);
    }

    public function createComment(array $commentData): array
    {
        $isSuccess = (new CommentRepository)->create($commentData);

        if(!$isSuccess) return $this->failResponse(400, "Comment failed!");

        return $this->successResponse(200, "Successfully commented!");
    }

    public function updateComment(array $commentData): array
    {
        return $this->failResponse(400, "Comment udpate failed!");
    }

    public function deleteComment($commentId): array
    {
        return $this->failResponse(400, "Comment delete failed!");
    }


}