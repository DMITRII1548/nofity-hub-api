<?php

namespace App\User\Infrastructure\Validator\Constraint;

use App\User\Infrastructure\Doctrine\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class UniqueEmailValidator extends ConstraintValidator
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueEmail) {
            throw new UnexpectedTypeException($constraint, UniqueEmail::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !$value instanceof \Stringable) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $email = (string) $value;

        if ($this->userRepository->findOneBy(['email' => $email])) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ email }}', $email)
                ->addViolation();
        }
    }
}