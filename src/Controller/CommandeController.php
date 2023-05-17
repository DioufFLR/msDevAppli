<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande/nouvelle', name: 'app_commande')]
    public function index(): Response
    {
        if (!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
}
