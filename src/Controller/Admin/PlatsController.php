<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Form\PlatsFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // On crée un nouveau plat
        $plat = new Plat();

        // On crée le formulaire
        $platForm = $this->createForm(PlatsFormType::class, $plat);

        // On traite la requête du formulaire
        $platForm->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if ($platForm->isSubmitted() && $platForm->isValid()){

            // On stock
            $entityManager->persist($plat);
            $entityManager->flush();

            $this->addFlash('success', 'Plat ajouté avec succès');

            // On redirige
            return $this->redirectToRoute('admin_plats_index');
        }

        return $this->renderForm('admin/plats/add.html.twig', compact('platForm'));
    }

    // Modifier un plat
    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Plat $plat, Request $request, EntityManagerInterface $entityManager): Response
    {
        // On vérifie si l'utilisateur peut éditer avec le Voter
        $this->denyAccessUnlessGranted('PLAT_EDIT', $plat);

        // On crée le formulaire
        $platForm = $this->createForm(PlatsFormType::class, $plat);

        // On traite la requête du formulaire
        $platForm->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if ($platForm->isSubmitted() && $platForm->isValid()){

            // On stock
            $entityManager->persist($plat);
            $entityManager->flush();

            $this->addFlash('success', 'Plat modifié avec succès');

            // On redirige
            return $this->redirectToRoute('admin_plats_index');
        }

        return $this->renderForm('admin/plats/edit.html.twig', compact('platForm'));

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