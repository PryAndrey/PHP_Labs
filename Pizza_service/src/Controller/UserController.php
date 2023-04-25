<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Database\ConnectionProvider;
use App\Database\UserTable;
use App\Database\PizzaTable;
use App\Model\User;
use App\Model\Upload;
use App\View\PhpTemplateEngine;

class UserController extends AbstractController
{
    // private const HTTP_STATUS_303_SEE_OTHER = 303;
    private UserTable $userTable;
    // private PizzaTable $pizzaTable;
    private Upload $upload;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
        // $this->pizzaTable = new PizzaTable($connection);
        $this->upload = new Upload();
    }

    public function index(): Response
    {
        $contents = PhpTemplateEngine::render('userForm.php');
        return new Response($contents);
    }

    public function registerUser(Request $request): Response
    {
        $userAvatar = null;
        if ($_FILES["avatar_path"] !== null) {
            $userAvatar = $this->upload->moveImageToUploads($_FILES["avatar_path"]);
        }

        $user = new User(
            null,
            $request->get('first_name'),
            $request->get('second_name'),
            $request->get('email'),
            $request->get('password'),
            $request->get('phone'),
            $userAvatar
        );
        $userId = $this->userTable->saveUser($user);

        return $this->redirectToRoute(
            'show_catalog',
            ['userId' => $userId],
            Response::HTTP_SEE_OTHER
        );

    }

    public function showUser(int $userId): Response
    {
        $user = $this->userTable->findUser($userId);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        $contents = PhpTemplateEngine::render('showUser.php', [
            'user' => $user
        ]);
        return new Response($contents);
    }
}