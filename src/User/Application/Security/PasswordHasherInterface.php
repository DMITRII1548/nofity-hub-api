<?php

namespace App\User\Application\Security;

interface PasswordHasherInterface
{
    public function hash(string $password): string;
}