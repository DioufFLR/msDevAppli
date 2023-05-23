<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/commande/nouvelle', name: 'app_commande')]
    public function index(CartService $cartService): Response
    {
        if (!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);
        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
            'recapCart' => $cartService->getTotal()
        ]);
    }

    #[Route('/commande/verifier', name: 'order_prepare', methods: ['POST'])]
    public function prepareOrder(Request $request): Response
    {
        $form = $this->createForm(CommandeType::class, null, [
                'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $datetime = new \DateTimeImmutable('now');
                $transporter = $form->get('transporteur')->getData();
                $delivery = $form->get('adresses')->getData();
                $deliveryForOrder = $delivery->getPrenom() . ' ' . $delivery->getNom();
                $deliveryForOrder .= '</br>' . $delivery->getTelephone();
                if ($delivery->getSociete()){
                    $deliveryForOrder .= ' - ' . $delivery->getSociete();
                }
                $deliveryForOrder .= '</br>' . $delivery->getAdresse();
                $deliveryForOrder .= '</br>' . $delivery->getCd() . ' - ' . $delivery->getVille();
                $deliveryForOrder .= '</br>' . $delivery->getPays();
                $order = new Commande();
                $reference = $datetime->format('dmY') . '-' . uniqid();
                $order->setUtilisateur($this->getUser())
                    ->setReference($reference)
                    ->setDateCommande($datetime)
                    ->setLivraison($deliveryForOrder)
                    ->setTransporteurNom($transporter->getTitre)
                    ->setTransporteurPrix($transporter->getPrix)
                    ->setIsPaid(0)
                    ->setMethode('stripe');

                $this->em->persist($order);
            }


        return $this->render('commande/recap.html.twig');
    }
}
