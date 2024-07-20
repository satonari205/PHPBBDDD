<?php

namespace App\Repositories;

use App\Domain\Models\User;
use PDO;

class UserRepository extends Repository
{
    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM Users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $this->getUserModel($user) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM Users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $this->getUserModel($user) : null;
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
            ':password' => $user->getHashedPassword(),
            ':created_at' => $user->getCreatedAt(),
            ':updated_at' => $user->getUpdatedAt()
        ]);
    }

    private function getUserModel(array $user): User
    {
        return new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['password'],
            $user['created_at'],
            $user['updated_at'],
        );
    }
}
