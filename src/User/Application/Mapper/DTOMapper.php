<?php

namespace App\User\Application\Mapper;

use App\User\Application\DTO\UserInputDTO;
use App\User\Application\DTO\UserOutputDTO;
use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\EmailValueObject;

final class DTOMapper
{
    public function toUserEntityFromDTO(UserInputDTO $DTO): User
    {
        $user = new User();

        $user->setName($DTO->name ?? '');
        $user->setEmail(new EmailValueObject($DTO->email ?? ''));
        $user->setPassword($DTO->password ?? '');

        return $user;
    }

    public function toOutputUserDTOFromUser(User $user): UserOutputDTO
    {
        $outputDTO = new UserOutputDTO();

        $email = $user->getEmail();

        $outputDTO->id = $user->getId();
        $outputDTO->name = $user->getName();
        $outputDTO->email = $email ? $email->value : '';

        return $outputDTO;
    }
}