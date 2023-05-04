<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\PlatRepository;
use phpDocumentor\Reflection\Location;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlatController extends AbstractController
{
    /**
     * This function display all plats
     *
     * @param PlatRepository $platRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/plat', name: 'app_plat_index')]
    public function index(PlatRepository $platRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $liste = $paginator->paginate(
            $platRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('plat/index.html.twig', [
            'liste' => $liste
        ]);
    }
}
