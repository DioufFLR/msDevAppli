<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CategorieRepository $categorieRepository, PlatRepository $platRepository): Response
    {
        $liste = $categorieRepository->findAll();
        $listePlats = $platRepository->findAll();

        return $this->render('main/index.html.twig', [
            'liste' => $liste,
            'listePlats' => $listePlats
        ]);
    }


}
