<?php

namespace App\Domain\Models;

use App\Exceptions\InvalidArgumentException;

class User
{
    private int $id; // 識別子
    private string $name;
    private string $email;
    private string $password;
    private string $created_at;
    private string $updated_at;

    public function __construct(
        string $name,
        string $email,
        string $password,
        string $created_at,
        string $updated_at,
    ) {
        try {
            $this->setName($name)
                ->setEmail($email)
                ->setPassword($password)
                ->setCreatedAt($created_at)
                ->setUpdatedAt($updated_at);
        } catch (InvalidArgumentException $e) {
            return $e->getMessage();
        }
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getHashedPassword(): string
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    private function setCreatedAt(string $timestamp): self
    {
        $this->created_at = $timestamp;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    private function setUpdatedAt(string $timestamp): self
    {
        $this->updated_at = $timestamp;
        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
