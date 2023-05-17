<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cartService->getTotal()
        ]);
    }

    #[Route('/panier/ajout/{id<\d+>}', name: 'app_cart_add')]
    public function addToCart(CartService $cartService, Plat $plat): Response
    {
        $cartService->addToCart($plat->getId());

       return $this->redirectToRoute('app_cart');
    }

    #[Route('/panier/remove/{id<\d+>}', name: 'app_cart_remove')]
    public function removeToCart(CartService $cartService, Plat $plat): Response
    {
        $cartService->removeToCart($plat->getId());

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/panier/decrease/{id<\d+>}', name: 'app_cart_decrease')]
    public function decrease(CartService $cartService, Plat $plat): RedirectResponse
    {
        $cartService->decrease($plat->getId());

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/panier/tout-supprimer', name: 'app_cart_removeAll')]
    public function removeAll(CartService $cartService): Response
    {
        $cartService->removeCartAll();

        return $this->redirectToRoute('app_main');
    }
}
