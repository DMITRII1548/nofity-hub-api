<?php

namespace App\User\Infrastructure\Mapper;

use App\User\Domain\Entity\User as DomainUser;
use App\User\Domain\ValueObject\EmailValueObject;
use App\User\Infrastructure\Doctrine\Entity\User;
use LogicException;

final class UserMapper
{
    public function toDoctrineEntity(DomainUser $domainUser): User
    {
        $user = new User();

        $email = $domainUser->getEmail();
        $user->setName($domainUser->getName() ?? '');
        $user->setEmail($email ? $email->value : '');
        $user->setPassword($domainUser->getPassword() ?? '');

        return $user;
    }

    public function toDomainEntity(User $user): DomainUser
    {
        $domainUser = new DomainUser();

        $id = $user->getId();

        if (!$id) {
            throw new LogicException('The User Entity ID is required');
        }

        $domainUser->setId($id);
        $domainUser->setName($user->getName() ?? '');
        $domainUser->setEmail(new EmailValueObject($user->getEmail() ?? ''));
        $domainUser->setPassword($user->getPassword() ?? '');

        return $domainUser;
    }
}
