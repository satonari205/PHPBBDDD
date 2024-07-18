<?php

namespace App\Models;

use App\ValueObjects\UserName;
use App\ValueObjects\Email;
use App\ValueObjects\Password;
use InvalidArgumentException;

class User
{
    private int $id; // 識別子
    private UserName $name;
    private Email $email;
    private Password $password;
    private int $created_at;
    private int $updated_at;

    public function __construct(
        string $name,
        string $email,
        string $password,
        int $created_at = null,
        int $updated_at = null,
    ) {
        try {
            var_dump($name, $email);
            $this->setName(new UserName($name))
                ->setEmail(new Email($email))
                ->setPassword(new Password($password))
                ->setCreatedAt($created_at ?? time())
                ->setUpdatedAt($updated_at ?? time());
        } catch (InvalidArgumentException $e) {
            var_dump($e->getMessage());
            return $e->getMessage();
        }
    }

    public function setName(UserName $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function setEmail(Email $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email->getValue();
    }

    public function setPassword(Password $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password->getHashedPassword();
    }

    private function setCreatedAt(int $timestamp): self
    {
        $this->created_at = $timestamp;
        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    private function setUpdatedAt(int $timestamp): self
    {
        $this->updated_at = $timestamp;
        return $this;
    }

    public function getUpdatedAt(): int
    {
        return $this->updated_at;
    }
}