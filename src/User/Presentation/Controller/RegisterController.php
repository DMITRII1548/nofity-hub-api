<?php

namespace App\User\Presentation\Controller;

use App\Shared\Infrastructure\Validator\DTOValidator;
use App\User\Application\Service\CreateUserHandler;
use App\User\Infrastructure\Factory\DTOFactory;
use App\User\Infrastructure\Mapper\DTOMapper;
use App\User\Presentation\ResponseBuilder\UserResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController
{
    #[Route(path: '/api/auth/register', name: 'auth_register', methods: ['POST'])]
    public function __invoke(
        Request $request, 
        DTOFactory $DTOFactory,
        DTOMapper $dTOMapper,
        DTOValidator $DTOValidator,
        CreateUserHandler $createUserHandler,
        UserResponseBuilder $userResponseBuilder
    ): JsonResponse
    {
        /** @var array<string, string> $data */
        $data = (array) json_decode($request->getContent(), true);

        $userInputDTO = $DTOFactory->makeUserInputDTO($data);

        $DTOValidator->validate($userInputDTO);

        $userInputDTO = $dTOMapper->toApplicationUserInputDTO($userInputDTO);

        $user = $DTOFactory->makeRegisterUserOutputDTO(
            $createUserHandler->handle($userInputDTO)
        );

        return $userResponseBuilder->registerUserResponse($user);
    }
}