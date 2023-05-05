<?php

namespace App\Repository;

use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PizzaRepository
{
    private EntityManagerInterface $entityManeger;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManeger = $entityManager;
        $this->repository = $entityManager->getRepository(Pizza::class);
    }

    public function findById(int $id): ?Pizza
    {
        return $this->repository->findOneBy(["pizza_id" => (string) $id]);
    }

    public function store(Pizza $pizza): int
    {
        $this->entityManeger->persist($pizza);
        $this->entityManeger->flush();
        return $pizza->getPizzaId();
    }

    public function delete(Pizza $pizza): void
    {
        $this->entityManeger->remove($pizza);
        $this->entityManeger->flush();
    }

    public function getListAll(): array
    {
        return $this->repository->findAll();
    }

}