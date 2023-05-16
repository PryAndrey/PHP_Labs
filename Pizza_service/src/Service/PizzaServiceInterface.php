<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Data\PizzaData;

interface PizzaServiceInterface
{
  public function savePizza(string $pizzaTitle, int $pizzaCost, string $pizzaDescription, string $pizzaStructure, ?string $pizzaImage): int;

  public function getPizza(int $pizzaId): PizzaData;
  public function getPizzaByTitle(string $title): PizzaData|null;
  public function deletePizza(int $pizzaId): void;

  public function listPizzas(): array;
}