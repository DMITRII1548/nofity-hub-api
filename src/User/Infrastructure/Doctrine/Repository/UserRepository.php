<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Doctrine\Repository;

use App\User\Domain\Entity\User as DomainUser;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infrastructure\Doctrine\Entity\User;
use App\User\Infrastructure\Mapper\UserMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $em,
        private UserMapper $userMapper
    )
    {
        parent::__construct($registry, User::class);
    }

    public function save(DomainUser $user): DomainUser
    {
        $user = $this->userMapper->toDoctrineEntity($user);
        
        $this->em->persist($user);

        $this->em->flush();

        return $this->userMapper->toDomainEntity($user);
    }
}
