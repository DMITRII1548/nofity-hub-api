<?php

namespace App\Shared\Infrastructure\Validator;

use App\Shared\Domain\Exception\InValidateException;
use App\Shared\Infrastructure\Intefrace\ValidateableDTOInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class DTOValidator
{
    public function __construct(
        private ValidatorInterface $validator
    )
    {
        
    }

    public function validate(ValidateableDTOInterface $DTO): void
    {
        $errors = $this->validator->validate($DTO);

        if ($errors->count() > 0) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }

            throw new InValidateException($messages);
        }
    }
}