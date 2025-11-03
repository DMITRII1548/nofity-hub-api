<?php

namespace App\User\Domain\Entity;

use App\User\Domain\ValueObject\EmailValueObject;

final class User
{
    private ?int $id = null;

    private ?string $name = null;

    private ?EmailValueObject $email = null;

    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?EmailValueObject
    {
        return $this->email;
    }

    public function setEmail(EmailValueObject $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}