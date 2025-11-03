<?php

namespace App\Shared\Domain\Exception;

use RuntimeException;

final class InValidateException extends RuntimeException
{
    /**
     * @var array<string, array<string>>
     */
    public readonly array $errors;

    /**
     * @param array<string, array<string>> $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;

        parent::__construct('InValidArguments', 422);
    }
}