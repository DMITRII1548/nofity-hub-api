<?php

namespace App\User\Presentation\Resource;

use App\User\Infrastructure\DTO\RegisterUserOutputDTO;
use Symfony\Component\Serializer\SerializerInterface;

final class UserResource
{
    public function __construct(
        private SerializerInterface $serializer
    )
    {
        
    }

    public function registerUserItem(RegisterUserOutputDTO $userOutputDTO): string
    {
        return $this->serializer->serialize($userOutputDTO, 'json', ['groups' => 'user:item']);
    }
}