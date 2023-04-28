<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\PizzaTable;
use App\Database\UserTable;
use App\Database\ConnectionProvider;
use App\Model\Upload;
use App\Model\User;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StorefrontController extends AbstractController
{
    private PizzaTable $pizzaTable;
    private UserTable $userTable;
    private Upload $upload;
    private Environment $twig;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->pizzaTable = new PizzaTable($connection);
        $this->userTable = new UserTable($connection);
        $this->upload = new Upload();
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function showCatalog(int $userId): Response
    {
        // $connection = ConnectionProvider::connectDatabase();
        // $this->pizzaTable = new PizzaTable($connection);
        // $this->userTable = new UserTable($connection);
        // $this->upload = new Upload();
        
        $user = $this->userTable->findUser($userId);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        $pizzas = $this->pizzaTable->getAllPizzas();

        $contents = $this->twig->render("showCatalog.html.twig", [
            "title" => "Pizza service",
            "pizzas" => $pizzas,
            "user" => $user
        ]);

        return new Response($contents);
    }

}