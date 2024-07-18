<?php

namespace App\Repositories;

use App\Domain\Models\User;
use PDO;

class UserRepository extends Repository
{
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM Users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM Users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function create(User $user)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO Users (name, email, password, created_at, updated_at)'
            . ' ' .
            'VALUES (:name, :email, :password, :created_at, :updated_at)'
        );

        $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':created_at' => $user->getCreatedAt(),
            ':updated_at' => $user->getUpdatedAt()
        ]);

        $user->setId($this->db->lastInsertId());

        return $user;
    }
}
