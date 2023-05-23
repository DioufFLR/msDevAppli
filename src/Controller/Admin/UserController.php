<?php

namespace App\Controller\Admin;

use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/users', name: 'admin_users_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        $user = $utilisateurRepository->findBy([], ['id' => 'asc']);

        return $this->render('admin/users/index.html.twig', compact('user'));
    }
}
