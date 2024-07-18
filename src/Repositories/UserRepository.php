<?php

namespace App\Repositories;

use App\Domain\Models\User;
use PDO;

class UserRepository extends Repository
{
    private $pdo;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function create(User $user)
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (name, email, password, created_at, updated_at)'
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

        $user->setId($this->pdo->lastInsertId());

        return $user->getAllValue();
    }
}
