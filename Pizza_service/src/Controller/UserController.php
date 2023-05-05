<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Model\Upload;
use App\View\PhpTemplateEngine;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class UserController extends AbstractController
{
    private UserRepository $userRepository;
    private Upload $upload;
    private Environment $twig;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->upload = new Upload();
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function index(): Response
    {
        $contents = $this->twig->render("userForm.html.twig");
        return new Response($contents);
    }

    public function registerUser(Request $request): Response
    {
        $userAvatar = $_FILES["avatar_path"] !== null ? $this->upload->moveImageToUploads($_FILES["avatar_path"]) : null;

        $user = new User(
            null,
            $request->get('first_name'),
            $request->get('second_name'),
            $request->get('email'),
            $request->get('password'),
            $request->get('phone'),
            $userAvatar
        );
        $userId = $this->userRepository->store($user);

        return $this->redirectToRoute(
            'show_catalog',
            ['userId' => $userId],
            Response::HTTP_SEE_OTHER
        );

    }

    public function showUser(int $userId): Response
    {
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        $contents = PhpTemplateEngine::render('showUser.php', [
            'user' => $user
        ]);
        return new Response($contents);
    }
}