<?php

namespace App\Controller;

use App\Form\CommandeType;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande/nouvelle', name: 'app_commande')]
    public function index(CartService $cartService): Response
    {
        if (!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);
        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
            'recapCart' => $cartService->getTotal()
        ]);
    }

    #[Route('/commande/verify', name: 'order_prepare', methods: ['POST'])]
    public function prepareOrder(Request $request): Response
    {
        $form = $this->createForm(CommandeType::class, null, [
                'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        dd($form->getData());


        return $this->render('commande/recap.html.twig');
    }
}
