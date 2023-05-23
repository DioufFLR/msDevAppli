<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use App\Repository\UtilisateurRepository;
use PHPUnit\Framework\MockObject\Rule\InvokedAtLeastCount;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CategorieRepository $categorieRepository, PlatRepository $platRepository): Response
    {
        $liste = $categorieRepository->findAll();
        $listePlats = $platRepository->findBy(
            ['id' => ['1', '4', '3']],
            ['libelle' => 'asc']
        );

        return $this->render('main/index.html.twig', [
            'liste' => $liste,
            'listePlats' => $listePlats
        ]);
    }
}
