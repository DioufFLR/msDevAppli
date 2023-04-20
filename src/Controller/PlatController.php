<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlatController extends AbstractController
{
    #[Route('/plat', name: 'app_plat_index')]
    public function index(PlatRepository $platRepository): Response
    {
        $liste = $platRepository->findAll();

        return $this->render('plat/index.html.twig', [
            'liste' => $liste
        ]);
    }

    #[Route('/detail/{categorie}', name: 'app_plat_detail')]
    public function detail(Categorie $categorie): Response
    {
        return $this->render('plat/index.html.twig', [
            "categorie" => $categorie
        ]);
    }
}
