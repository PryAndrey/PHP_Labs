<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\UserServiceInterface;
use App\Service\PizzaServiceInterface;
use App\Service\ImageServiceInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StorefrontController extends AbstractController
{
    private PizzaServiceInterface $pizzaService;
    private UserServiceInterface $userService;
    private ImageServiceInterface $imageService;
    private Environment $twig;

    public function __construct(PizzaServiceInterface $pizzaService, UserServiceInterface $userService, ImageServiceInterface $imageService)
    {
        $this->pizzaService = $pizzaService;
        $this->userService = $userService;
        $this->imageService = $imageService;
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function registerPizza(Request $request): Response
    {
        $pizzaImage = isset($_FILES["pizza_image"]) ? $this->imageService->moveImageToUploads($_FILES["pizza_image"]) : null;

        $pizzaId = $this->pizzaService->savePizza(
            $request->get('pizza_title'),
            $request->get('pizza_cost'),
            $request->get('pizza_description'),
            $request->get('pizza_structure'),
            $pizzaImage
        );

        return $this->redirectToRoute('show_catalog');
    }

    public function showPizza(int $pizzaId): Response
    {
        $pizza = $this->pizzaService->getPizza($pizzaId);
        return $this->render('showPizza.html.twig', [
            "pizza" => $pizza
        ]);
    }

    public function deletePizza(int $pizzaId): Response
    {
        $this->pizzaService->deletePizza($pizzaId);
        return $this->redirectToRoute('pizzas_list');
    }


    public function listPizzas(int $userId): Response
    {
        $user = $this->userService->getUser($userId);
        $pizzas = $this->pizzaService->listPizzas();

        return $this->render('showCatalog.html.twig', [
            "title" => "Pizza service",
            "pizzas_list" => $pizzas,
            "user" => $user
        ]);
    }
}