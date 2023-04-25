<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/plats', name: 'admin_plats_')]
class PlatsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }

    // Ajouter un plat
    #[Route('/ajout', name: 'add')]
    public function add(): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }

    // Modifier un plat
    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Plat $plat): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }

    // Supprimer un plat
    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Plat $plat): Response
    {
        return $this->render('admin/plats/index.html.twig');
    }
}