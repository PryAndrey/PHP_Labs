<?php

namespace App\Service;

use App\Repository\PizzaRepository;
use App\Entity\Pizza;
use App\Service\Data\PizzaData;

class PizzaService implements PizzaServiceInterface
{
  private PizzaRepository $pizzaRepository;

  public function __construct(PizzaRepository $pizzaRepository)
  {
    $this->pizzaRepository = $pizzaRepository;
  }
  public function savePizza(string $pizzaTitle, int $pizzaCost, string $pizzaDescription, string $pizzaStructure, ?string $pizzaImage): int
  {
    $pizza = new Pizza(
      null,
      $pizzaTitle,
      $pizzaCost,
      $pizzaDescription,
      $pizzaStructure,
      $pizzaImage
    );
    return $this->pizzaRepository->store($pizza);
  }
  public function getPizza(int $pizzaId): PizzaData
  {
    $pizza = $this->pizzaRepository->findById($pizzaId);
    if ($pizza === null) {
      throw $this->createNotFoundException();
    }

    return new PizzaData(
      $pizza->getPizzaId(),
      $pizza->getPizzaTitle(),
      $pizza->getPizzaCost(),
      $pizza->getPizzaDescription(),
      $pizza->getPizzaStructure(),
      $pizza->getPizzaImage(),
    );
  }

  public function getPizzaByTitle(string $title): PizzaData|null
  {
    $pizza = $this->pizzaRepository->findByTitle($title);
    if ($pizza === null) {
      return null;
    }

    return new PizzaData(
      $pizza->getPizzaId(),
      $pizza->getPizzaTitle(),
      $pizza->getPizzaCost(),
      $pizza->getPizzaDescription(),
      $pizza->getPizzaStructure(),
      $pizza->getPizzaImage(),
    );
  }

  public function deletePizza(int $pizzaId): void
  {
    $pizza = $this->pizzaRepository->findById($pizzaId);
    if ($pizza === null) {
      throw $this->createNotFoundException();
    }

    $this->pizzaRepository->delete($pizza);
  }
  public function listPizzas(): array
  {
    $pizzas = $this->pizzaRepository->getListAll();

    $pizzasView = [];
    foreach ($pizzas as $pizza) {
      $pizzasView[] = new PizzaData(
        $pizza->getPizzaId(),
        $pizza->getPizzaTitle(),
        $pizza->getPizzaCost(),
        $pizza->getPizzaDescription(),
        $pizza->getPizzaStructure(),
        $pizza->getPizzaImage(),
      );
    }

    return $pizzasView;
  }
}