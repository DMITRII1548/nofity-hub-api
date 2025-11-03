<?php

namespace App\User\Infrastructure\DTO;

use Symfony\Component\Serializer\Attribute\Groups;

final class RegisterUserOutputDTO
{
    #[Groups('user:item')]
    public ?int $id = null;

    #[Groups('user:item')]
    public ?string $name = null;

    #[Groups('user:item')]
    public ?string $email = null;

    #[Groups('user:item')]
    public ?string $token = null;
}