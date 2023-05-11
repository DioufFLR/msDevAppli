<?php

namespace App\Service;

use App\Entity\Plat;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\PseudoTypes\IntegerValue;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private RequestStack $requestStack;

    private EntityManagerInterface $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    public function addToCart(int $id): void
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->getSession()->set('cart', $cart);
    }

    public function removeCartAll()
    {
        return $this->getSession()->remove('cart');
    }

    public function getTotal(): array
    {
        $cart = $this->getSession()->get('cart');
        $cartData = [];
        if ($cart)
        {
            foreach ($cart as $id => $quatity)
            {
                $plat = $this->em->getRepository(Plat::class)->findOneBy(['id' => $id]);
                if (!$plat){
                    // Supprimer le produit puis continuer en sortant de la boucle
                }

                $cartData[] = [
                    'plat' => $plat,
                    'quantiy' => $quatity
                ];
            }
        }
        return $cartData;
    }

    private function getSession()
    {
        return $this->requestStack->getSession();
    }
}