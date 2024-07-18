<?php

namespace App\Domain\Models;

use App\Domain\ValueObjects\User\UserName;
use App\Domain\ValueObjects\User\Email;
use App\Domain\ValueObjects\User\Password;
use App\Exceptions\InvalidArgumentException;

class User
{
    private int $id; // 識別子
    private UserName $name;
    private Email $email;
    private Password $password;
    private string $created_at;
    private string $updated_at;

    public function __construct(
        string $name,
        string $email,
        string $password,
        string $created_at = null,
        string $updated_at = null,
    ) {
        try {
            $this->setName(new UserName($name))
                ->setEmail(new Email($email))
                ->setPassword(new Password($password))
                ->setCreatedAt($created_at ?? date('Y-m-d H:i:s', time()))
                ->setUpdatedAt($updated_at ?? date('Y-m-d H:i:s', time()));
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