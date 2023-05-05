<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Exception;

class UserRepository
{
    private EntityManagerInterface $entityManeger;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManeger = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function findById(int $id): ?User
    {
        return $this->repository->findOneBy(["userId" => (string) $id]);
    }

    public function store(User $user): int
    {
        $this->entityManeger->persist($user);
        $this->entityManeger->flush();
        return $user->getUserId();
    }

    public function delete(User $user): void
    {
        $this->entityManeger->remove($user);
        $this->entityManeger->flush();
    }

    public function getListAll(): array
    {
        return $this->repository->findAll();
    }
}