<?php

namespace App\Model;

class Pizza
{
    private ?int $pizzaId;
    private string $pizzaTitle;
    private string $pizzaCost;
    private string $pizzaDescription;
    private string $pizzaStructure;
    private string $pizzaImage;

    public function __construct(
        ?int $pizzaId,
        string $pizzaTitle,
        string $pizzaCost,
        string $pizzaDescription,
        string $pizzaStructure,
        string $pizzaImage
    ) {
        $this->pizzaId = $pizzaId;
        $this->pizzaTitle = $pizzaTitle;
        $this->pizzaCost = $pizzaCost;
        $this->pizzaDescription = $pizzaDescription;
        $this->pizzaStructure = $pizzaStructure;
        $this->pizzaImage = $pizzaImage;
    }

    public function getPizzaId(): ?int
    {
        return $this->pizzaId;
    }

    public function getPizzaTitle(): string
    {
        return $this->pizzaTitle;
    }

    public function getPizzaCost(): string
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

}