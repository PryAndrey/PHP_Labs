<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Data\PizzaData;

interface PizzaServiceInterface
{
  public function savePizza(string $pizzaTitle, int $pizzaCost, string $pizzaDescription, string $pizzaStructure, ?string $pizzaImage): int;

  public function getPizza(int $userId): PizzaData;

  public function deletePizza(int $userId): void;

  public function listPizzas(): array;
}