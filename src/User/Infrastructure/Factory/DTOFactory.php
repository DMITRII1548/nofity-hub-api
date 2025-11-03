<?php

namespace App\User\Infrastructure\Factory;

use App\User\Application\DTO\UserInputDTO as ApplicationUserInputDTO;
use App\User\Application\DTO\UserOutputDTO;
use App\User\Infrastructure\Doctrine\Entity\User;
use App\User\Infrastructure\DTO\RegisterUserOutputDTO;
use App\User\Infrastructure\DTO\UserInputDTO;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use LogicException;

final class DTOFactory
{
    public function __construct(
        private JWTTokenManagerInterface $jWTTokenManager,
        private EntityManagerInterface $em,
    )
    {
        
    }
    /**
     * @param array<string, string> $data
     */
    public function makeUserInputDTO(array $data): UserInputDTO
    {
        $DTO = new UserInputDTO();

        $DTO->name  = $data['name'] ?? null;
        $DTO->email = $data['email'] ?? null;
        $DTO->password = $data['password'] ?? null;

        return $DTO;
    }

    public function makeRegisterUserOutputDTO(UserOutputDTO $userOutputDTO): RegisterUserOutputDTO
    {
        $registerUserOutputDTO = new RegisterUserOutputDTO();

        $user = $this->em->getReference(User::class, $userOutputDTO->id);

        if (!($user instanceof User)) {
            throw new LogicException("The $user @variable must be " . User::class);
        }

        $registerUserOutputDTO->id = $userOutputDTO->id;
        $registerUserOutputDTO->name = $userOutputDTO->name;
        $registerUserOutputDTO->email = $userOutputDTO->email;
        $registerUserOutputDTO->token = $this->jWTTokenManager->create(
            $user
        );

        return $registerUserOutputDTO;
    }
}