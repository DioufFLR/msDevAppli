<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Form\PlatsFormType;
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // On crée un nouveau plat
        $plat = new Plat();

        // On crée le formulaire
        $platForm = $this->createForm(PlatsFormType::class, $plat);

        return $this->renderForm('admin/plats/add.html.twig', compact('platForm'));
    }

    // Modifier un plat
    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Plat $plat): Response
    {
        // On vérifie si l'utilisateur peut éditer avec le Voter
        $this->denyAccessUnlessGranted('PLAT_EDIT', $plat);
        return $this->render('admin/plats/index.html.twig');
    }

    // Supprimer un plat
    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Plat $plat): Response
    {
        // On vérifie si l'utilisateur peut supprimer avec le Voter
        $this->denyAccessUnlessGranted('PLAT_DELETE', $plat);
        return $this->render('admin/plats/index.html.twig');
    }
}