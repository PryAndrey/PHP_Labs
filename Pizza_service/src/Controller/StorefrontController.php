<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\PizzaRepository;
use App\Model\Upload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StorefrontController extends AbstractController
{
    private PizzaRepository $pizzaRepository;
    private UserRepository $userRepository;
    private Upload $upload;
    private Environment $twig;

    public function __construct(PizzaRepository $pizzaRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->pizzaRepository = $pizzaRepository;
        $this->upload = new Upload();
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function showCatalog(int $userId): Response
    {        
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        $pizzas = $this->pizzaRepository->getListAll();

        $contents = $this->twig->render("showCatalog.html.twig", [
            "title" => "Pizza service",
            "pizzas" => $pizzas,
            "user" => $user
        ]);

        return new Response($contents);
    }
}