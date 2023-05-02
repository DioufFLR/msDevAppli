<?php

namespace App\Controller\Admin;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/categorie', name: 'admin_categorie_')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findBy([], ['libelle' => 'asc']);

        return $this->render('admin/categorie/index.html.twig', compact('categorie'));
    }
}