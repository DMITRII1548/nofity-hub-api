<?php

namespace App\User\Application\Service;

use App\User\Application\DTO\UserInputDTO;
use App\User\Application\DTO\UserOutputDTO;
use App\User\Application\Mapper\DTOMapper;
use App\User\Application\Security\PasswordHasherInterface;
use App\User\Domain\Repository\UserRepositoryInterface;

class CreateUserHandler
{
    public function __construct(
        private PasswordHasherInterface $passwordHasher,
        private UserRepositoryInterface $userRepository,
        private DTOMapper $DTOMapper,
    )
    {
        
    }

    public function handle(UserInputDTO $userInputDTO): UserOutputDTO
    {
        $userInputDTO->password = $this->passwordHasher->hash((string)$userInputDTO->password);

        $userEntity = $this->DTOMapper->toUserEntityFromDTO($userInputDTO);

        $user = $this->userRepository->save($userEntity);

        return $this->DTOMapper->toOutputUserDTOFromUser($user);
    }
}