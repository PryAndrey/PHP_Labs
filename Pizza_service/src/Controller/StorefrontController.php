<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\PizzaTable;
use App\Database\UserTable;
use App\Database\ConnectionProvider;
use App\Model\Upload;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StorefrontController extends AbstractController
{
    private PizzaTable $pizzaTable;
    private UserTable $userTable;
    private Upload $upload;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->pizzaTable = new PizzaTable($connection);
        $this->userTable = new UserTable($connection);
        $this->upload = new Upload();
    }

    public function index(): Response
    {
        $pizzas = $this->pizzaTable->getAllPizzas();

        $contents = PhpTemplateEngine::render("showCatalog.php", [
            "pizzas" => $pizzas
        ]);

        return new Response($contents);
    }

    public function showCatalog(int $userId): Response
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->pizzaTable = new PizzaTable($connection);
        $this->userTable = new UserTable($connection);
        $this->upload = new Upload();
        
        $user = $this->userTable->findUser($userId);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        $pizzas = $this->pizzaTable->getAllPizzas();

        $contents = PhpTemplateEngine::render("showCatalog.php", [
            "user" => $user,
            "pizzas" => $pizzas
        ]);

        return new Response($contents);
    }

}