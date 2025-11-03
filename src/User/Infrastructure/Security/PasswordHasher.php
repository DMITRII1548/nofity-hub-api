<?php

namespace App\User\Infrastructure\Security;

use App\User\Application\Security\PasswordHasherInterface;
use App\User\Infrastructure\Doctrine\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class PasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {    
    }

    public function hash(string $password): string
    {
        $user = new User();

        return $this->userPasswordHasher->hashPassword($user, $password);
    }
}