<?php
declare(strict_types=1);

namespace App\Service\Data;

class PizzaData
{
  public function __construct(
    private ?int $pizzaId,
    private string $pizzaTitle,
    private int $pizzaCost,
    private string $pizzaDescription,
    private string $pizzaStructure,
    private string $pizzaImage
  ) {
  }
  public function getPizzaId(): ?int
  {
    return $this->pizzaId;
  }
  public function getPizzaTitle(): string
  {
    return $this->pizzaTitle;
  }
  public function getPizzaCost(): int
  {
    return $this->pizzaCost;
  }
  public function getPizzaDescription(): string
  {
    return $this->pizzaDescription;
  }
  public function getPizzaStructure(): string
  {
    return $this->pizzaStructure;
  }
  public function getPizzaImage(): string
  {
    return $this->pizzaImage;
  }
  public function getUploadUrlPath(string $fileName): string
  {
    return "/images/$fileName";
  }
  public function toArray(): array
  {
    return [
      'pizzaId' => $this->getPizzaId(),
      'pizzaTitle' => $this->getPizzaTitle(),
      'pizzaCost' => $this->getPizzaCost(),
      'pizzaDescription' => $this->getPizzaDescription(),
      'pizzaStructure' => $this->getPizzaStructure(),
      'pizzaImage' => $this->getPizzaImage(),
    ];
  }
}