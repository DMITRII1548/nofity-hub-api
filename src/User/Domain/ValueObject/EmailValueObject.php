<?php

namespace App\User\Domain\ValueObject;

use InvalidArgumentException;

final readonly class EmailValueObject
{
    public string $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidEmail($value);

        $this->value = $value;
    }

    private function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('The email <%s> is not valid', $email));
        }
    }
}