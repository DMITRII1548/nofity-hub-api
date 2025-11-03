<?php

namespace App\User\Infrastructure\Validator\Constraint;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute()]
final class UniqueEmail extends Constraint
{
    public string $message = 'Email "{{ email }}" is already in use.';

    public function __construct(
        mixed $options = null, 
        ?array $groups = null, 
        mixed $payload = null
    ) {
        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return UniqueEmailValidator::class;
    }
}