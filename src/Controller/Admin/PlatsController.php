<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Form\PlatsFormType;
use App\Repository\PlatRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/plats', name: 'admin_plats_')]
class PlatsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PlatRepository $platRepository): Response
    {
        $plat = $platRepository->findAll();

        return $this->render('admin/plats/index.html.twig', compact('plat'));
    }

    // Ajouter un plat
    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
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
            // On récupère les images
            $image = $platForm->get('image')->getData();

            // On définit le dossier de destination
            $folder = 'plat';

            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder, 300,  300);

            $plat->setImage($fichier);

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
    public function edit(Plat $plat, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        // On vérifie si l'utilisateur peut éditer avec le Voter
        $this->denyAccessUnlessGranted('PLAT_EDIT', $plat);

        // On crée le formulaire
        $platForm = $this->createForm(PlatsFormType::class, $plat);

        // On traite la requête du formulaire
        $platForm->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if ($platForm->isSubmitted() && $platForm->isValid()){

            // On récupère les images
            $image = $platForm->get('image')->getData();

            // On définit le dossier de destination
            $folder = 'plat';

            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder, 300,  300);

            $plat->setImage($fichier);

            // On stock
            $entityManager->persist($plat);
            $entityManager->flush();

            $this->addFlash('success', 'Plat modifié avec succès');

            // On redirige
            return $this->redirectToRoute('admin_plats_index');
        }

        return $this->render('admin/plats/edit.html.twig', [
            'platForm' => $platForm->createView(),
            'plat' => $plat
        ]);

//        return $this->renderForm('admin/plats/edit.html.twig', compact('platForm'));

//        return $this->render('admin/plats/index.html.twig');
    }

    // Supprimer un plat
    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Plat $plat, EntityManagerInterface $entityManager): Response
    {
        // On vérifie si l'utilisateur peut supprimer avec le Voter
        $this->denyAccessUnlessGranted('PLAT_DELETE', $plat);

        $entityManager->remove($plat);
        $entityManager->flush();

        return $this->redirectToRoute('admin_plats_index');
    }

    // Supprimer une image associé au plat
    #[Route('/suppression/image/{id}', name: 'delete_image', methods: ['DELETE'])]
    public function deleteImage(Plat $plat, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): JsonResponse
    {
        // On récupère le contenu de la requête
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete' . $plat->getImage(), $data['_token'])){
            // Le token csrf est valide
            // On récupère le nom de l'image
            $nom = $plat->getImage();

            if ($pictureService->delete($nom, 'plat', 300, 300)){

            }
            // La suppresion a echoué
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}