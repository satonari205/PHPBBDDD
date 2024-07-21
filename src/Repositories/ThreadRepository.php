<?php

namespace App\Repostories;

use App\Domain\Models\Thread;
use App\Repositories\Repository;
use PDO;

class ThreadRepository extends Repository
{
    public function save(Thread $thread)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO Threads (user_id, title, body, created_at, updated_at)'
            . ' ' .
            'VALUES (:user_id, :title, :body, :created_at, :updated_at)'
        );

        $stmt->execute([
            ':user_id' => $thread->getId(),
            ':title' => $thread->getTitle(),
            ':body' => $thread->getBody(),
            ':created_at' => $thread->getCreatedAt(),
            ':updated_at' => $thread->getUpdatedAt()
        ]);

        $threadData = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->getThreadModel($threadData);
    }

    private function getThreadModel(array|bool $threadData)
    {
        return new Thread(
            (int)$threadData['user_id'],
            $threadData['title'],
            $threadData['body'],
            $threadData['created_at'],
            $threadData['updated_at'],
            (int)$threadData['id'],
        );
    }
}