<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $liste = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'liste' => $liste
        ]);
    }

    #[Route('/categorie/{id}', name: 'app_categorie_detail')]
    public function detail(Categorie $categorie): Response
    {
        return $this->render('categorie/cat_plat.html.twig', [
            'categorie' => $categorie
        ]);
    }
}
