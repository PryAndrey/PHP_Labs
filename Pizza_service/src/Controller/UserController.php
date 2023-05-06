<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Service\UserServiceInterface;
use App\Service\ImageServiceInterface;
use App\View\PhpTemplateEngine;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class UserController extends AbstractController
{
    private UserServiceInterface $userService;
    private ImageServiceInterface $imageService;
    private Environment $twig;

    public function __construct(UserServiceInterface $userService, ImageServiceInterface $imageService)
    {
        $this->userService = $userService;
        $this->imageService = $imageService;
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(): Response
    {
        $contents = $this->twig->render("userForm.html.twig");
        return new Response($contents);
    }

    public function registerUser(Request $request): Response
    {
        $userAvatar = isset($_FILES["avatar_path"]) ? $this->imageService->moveImageToUploads($_FILES["avatar_path"]) : null;

        $userId = $this->userService->saveUser(
            $request->get('first_name'),
            $request->get('second_name'),
            $request->get('email'),
            $request->get('password'),
            $request->get('phone'),
            $userAvatar
        );

        return $this->redirectToRoute(
            'show_catalog',
            ['userId' => $userId],
            Response::HTTP_SEE_OTHER
        );
    }

    public function showUser(int $userId): Response
    {
        $user = $this->userService->getUser($userId);
        
        $contents = PhpTemplateEngine::render('showUser.php', [
            'user' => $user
        ]);
        return new Response($contents);
    }

    public function deleteUser(int $userId): Response
    {
        $this->userService->deleteUser($userId);

        return $this->redirectToRoute('list_users');
    }

    public function listUsers(): Response
    {
        $users = $this->userService->listUsers();
        $usersView = [];
        foreach ($users as $user) {
            $usersView[] = $user->toArray();
        }

        return $this->render('user/list.html.twig', [
            'users_list' => $usersView
        ]);
    }
}