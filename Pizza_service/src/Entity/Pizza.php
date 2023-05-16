<?php

namespace App\Entity;

class Pizza
{
    public function __construct(
        private ?int $pizzaId,
        private string $pizzaTitle,
        private int $pizzaCost,
        private string $pizzaDescription,
        private string $pizzaStructure,
        private string $pizzaImage
    ) { }

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
        return "/uploads/pizza/$fileName";
    }

}