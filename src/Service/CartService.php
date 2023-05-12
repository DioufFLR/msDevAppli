<?php

namespace App\Service;

use App\Entity\Plat;
use Doctrine\ORM\EntityManagerInterface;
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
        $cart = $this->getSession()->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->getSession()->set('cart', $cart);
    }

    public function removeToCart(int $id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        // J'enlève l'id du plat de la session
        unset($cart[$id]);

        // Je recrée une session pour actualiser la session
        return $this->getSession()->set('cart', $cart);
    }

    public function decrease(int $id)
    {
        $cart = $this->getSession()->get('cart', []);

        if($cart[$id] > 1){
            $cart[$id]--;
        } else {
            unset($cart[$id]);
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
            foreach ($cart as $id => $quantity)
            {
                $plat = $this->em->getRepository(Plat::class)->findOneBy(['id' => $id]);
                if (!$plat){
                    // Supprimer le produit puis continuer en sortant de la boucle
                }

                $cartData[] = [
                    'plat' => $plat,
                    'quantity' => $quantity
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