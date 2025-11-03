<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Mapper;

use App\User\Application\DTO\UserInputDTO as ApplicationUserInputDTO;
use App\User\Infrastructure\DTO\UserInputDTO as InfrastructureUserInputDTO;

final class DTOMapper
{
    public function toApplicationUserInputDTO(InfrastructureUserInputDTO $infrastructureDTO): ApplicationUserInputDTO
    {
        $applicationDTO = new ApplicationUserInputDTO();
        $applicationDTO->name = $infrastructureDTO->name;
        $applicationDTO->email = $infrastructureDTO->email;
        $applicationDTO->password = $infrastructureDTO->password;

        return $applicationDTO;
    }
}
