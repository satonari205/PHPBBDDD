<?php

namespace App\Repostories;

use App\Domain\Models\Thread;
use App\Repositories\Repository;
use PDO;


class ThreadRepository extends Repository
{
    public function find(int $id): ?Thread
    {
        $stmt = $this->db->prepare('SELECT * FROM Threads WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $thread = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->getThreadModel($thread);
    }

    public function all(
        int $page = 1,
        int $pageSize = 30,
        string $sort = 'created_at',
        string $order = 'desc',
        ?string $search = null
    ): ?array {
        // ページネーションのオフセット計算
        $offset = ($page - 1) * $pageSize;

        // 検索条件の設定
        $searchCondition = '';
        $params = [
            ':limit' => $pageSize,
            ':offset' => $offset,
        ];

        if (isset($search)) {
            $searchCondition = ' WHERE thread_title LIKE :search';
            $params[':search'] = '%' . $search . '%';
        }

        $stmt = $this->db->prepare(
            "SELECT * FROM Threads" .
            $searchCondition .                      // 文字の検索
            " ORDER BY " . $sort . " " .            // ソート
            $order . " LIMIT :limit OFFSET :offset" // ページネーション
        );

        $stmt->execute($params);

        $threadData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->getThreadModels($threadData);
    }

    public function save(Thread $thread): ?Thread
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

    public function update(Thread $thread): Thread
    {
        $stmt = $this->db->prepare(
            "UPDATE Threads SET title = :title, body = :body, updated_at = :updated_at WHERE id = :id"
        );

        $stmt->execute([
            ':id' => $thread->getId(),
            ':title' => $thread->getTitle(),
            ':body' => $thread->getBody(),
            ':updated_at' => date('Y-m-d H:i:s')
        ]);

        return $thread;
    }

    private function getThreadModel(array|bool $threadData): ?Thread
    {
        if($threadData === false){
            return null;
        }

        return new Thread(
            (int)$threadData['user_id'],
            $threadData['title'],
            $threadData['body'],
            $threadData['created_at'],
            $threadData['updated_at'],
            (int)$threadData['id'],
        );
    }

    private function getThreadModels(array|bool $threadData): ?array
    {
        if($threadData === false){
            return null;
        }
        return array_map(fn($thread) => $this->getThreadModel($thread), $threadData);
    }
}
