<?php

namespace App\User\Presentation\ResponseBuilder;

use App\User\Infrastructure\DTO\RegisterUserOutputDTO;
use App\User\Presentation\Resource\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UserResponseBuilder
{
    public function __construct(
        private UserResource $userResource
    )
    {
        
    }

    /**
     * @param array<string, string> $headers
     */
    public function registerUserResponse(
        RegisterUserOutputDTO $user, 
        int $status = 201, 
        array $headers = [], 
        bool $isJson = true,
    ): JsonResponse
    {

        $userResource = $this->userResource->registerUserItem($user);

        return new JsonResponse($userResource, $status, $headers, $isJson);
    }
}