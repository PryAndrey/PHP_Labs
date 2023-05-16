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
        return $this->redirectToRoute('home');
    }

    public function showLoginForm(): Response
    {
        $contents = $this->twig->render("./form/login.html.twig", []);
        return new Response($contents);
    }

    public function showRegistrationForm(): Response
    {
        $contents = $this->twig->render("./form/registration.html.twig", []);
        return new Response($contents);
    }

    public function registerUser(Request $request): Response
    {
        //session_start();

        $userAvatar = isset($_FILES["avatar_path"]) ? $this->imageService->moveImageToUploads($_FILES["avatar_path"], 'user') : null;

        $userEmail = $request->get("email");
        if ($this->userService->getUserByEmail($userEmail) !== null) {
            return $this->redirectToRoute("registration_form", [], Response::HTTP_SEE_OTHER);
        }

        $userId = $this->userService->saveUser(
            $request->get('first_name'),
            $request->get('second_name'),
            $request->get('email'),
            $request->get('password'),
            $request->get('phone'),
            $userAvatar
        );

        $_SESSION['email'] = $userEmail;
        return $this->redirectToRoute(
            'home',
            [],
            Response::HTTP_SEE_OTHER
        );
    }

    public function loginUser(Request $request): Response
    {
        //session_start();

        $userEmail = $request->get("email");
        $userPassword = $request->get("password");
        $user = $this->userService->getUserByEmail($userEmail);

        if ($user === null) {
            return $this->redirectToRoute("login_form", [], Response::HTTP_SEE_OTHER);
        }

        if (!$user->getPassword() === $userPassword) {
            return $this->redirectToRoute("login_form", [], Response::HTTP_SEE_OTHER);
        }

        $_SESSION["email"] = $userEmail;
        return $this->redirectToRoute("home", [], Response::HTTP_SEE_OTHER);
    }

    public function logout(): Response
    {
        session_start();
        $_SESSION["email"] = null;
        return $this->redirectToRoute("login_form", [], Response::HTTP_SEE_OTHER);
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