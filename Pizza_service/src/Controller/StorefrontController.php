<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\UserServiceInterface;
use App\Service\PizzaServiceInterface;
use App\Service\OrderServiceInterface;
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
    private OrderServiceInterface $orderService;
    private ImageServiceInterface $imageService;
    private Environment $twig;

    public function __construct(PizzaServiceInterface $pizzaService, UserServiceInterface $userService, OrderServiceInterface $orderService, ImageServiceInterface $imageService)
    {
        $this->pizzaService = $pizzaService;
        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->imageService = $imageService;
        $this->twig = new Environment(new FilesystemLoader("../templates"));
    }

    public function createPizzaForm(Request $request): Response
    {
        $contents = $this->twig->render("./form/createPizza.html.twig", []);
        return new Response($contents);
    }
    public function showThankYouPage(): Response
    {
        $contents = $this->twig->render("./order/thankYouPage.html.twig", []);
        return new Response($contents);
    }

    public function showPizza(int $pizzaId): Response
    {
        $pizza = $this->pizzaService->getPizza($pizzaId);
        return $this->render('showPizza.html.twig', [
            "pizza" => $pizza
        ]);
    }

    public function createOrder(Request $request): Response
    {
        $order = json_decode(file_get_contents('php://input'));
        date_default_timezone_set("Europe/Moscow");
        $orderId = $this->orderService->saveOrder(
            $order->products,
            $order->cost,
            $order->client,
            date("FY h:i:s A"),
            $order->address
        );
        return $this->redirectToRoute('show_thank_you_page', [], Response::HTTP_SEE_OTHER);
    }
    public function createPizza(Request $request): Response
    {
        $pizzaTitle = $request->get("pizza_title");
        if ($this->pizzaService->getPizzaByTitle($pizzaTitle) !== null) {
            return $this->redirectToRoute("create_pizza_form", [], Response::HTTP_SEE_OTHER);
        }

        if (!isset($_FILES["pizza_image"])) {
            return $this->redirectToRoute("create_pizza_form", [], Response::HTTP_SEE_OTHER);
        }

        $pizzaImage = $this->imageService->moveImageToUploads($_FILES["pizza_image"], 'pizza');
        $pizzaId = $this->pizzaService->savePizza(
            $request->get('pizza_title'),
            (int) $request->get('pizza_cost'),
            $request->get('pizza_description'),
            $request->get('pizza_structure'),
            $pizzaImage
        );
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }

    public function deletePizza(int $pizzaId): Response
    {
        $this->pizzaService->deletePizza($pizzaId);
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }

    public function listPizzas(): Response
    {
        session_start();
        // session_unset();
        if (!isset($_SESSION['email'])) {
            return $this->redirectToRoute("login_form");
        }

        $user = $this->userService->getUserByEmail($_SESSION['email']);
        if ($user === null) {
            return $this->redirectToRoute("login_form");
        }
        $pizzas = $this->pizzaService->listPizzas();

        return $this->render('pizza/catalog.html.twig', [
            "pizzas_list" => $pizzas,
            "user" => $user
        ]);
    }
}