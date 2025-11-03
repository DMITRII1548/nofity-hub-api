<?php

namespace App\User\Infrastructure\DTO;

use App\Shared\Infrastructure\Intefrace\ValidateableDTOInterface;
use App\User\Infrastructure\Validator\Constraint\UniqueEmail;
use Symfony\Component\Validator\Constraints as Assert;

final class UserInputDTO implements ValidateableDTOInterface
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    #[Assert\Type(['string'])]
    public ?string $name;
    
    #[Assert\NotBlank]
    #[Assert\Length(min: 5, max: 255)]
    #[Assert\Email()]
    #[Assert\Type(['string'])]
    #[UniqueEmail()]
    public ?string $email;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 8, max: 255)]
    #[Assert\Type(['string'])]
    #[Assert\PasswordStrength(minScore: Assert\PasswordStrength::STRENGTH_WEAK)]
    public ?string $password;
}