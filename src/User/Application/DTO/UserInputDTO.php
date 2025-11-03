<?php

namespace App\User\Application\DTO;

final class UserInputDTO
{
    public ?int $id;

    public ?string $name;

    public ?string $email;

    public ?string $password;
}