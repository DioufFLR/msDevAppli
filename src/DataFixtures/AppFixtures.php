<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cat1 = new Categorie();
        $cat1->setLibelle('Pizza');
        $cat1->setActive(1);
        $cat1->setImage('pizza_cat.jpg');

        $cat2 = new Categorie();
        $cat2->setLibelle('Pâtes');
        $cat2->setActive(1);
        $cat2->setImage('pasta_cat.jpg');

        $cat3 = new Categorie();
        $cat3->setLibelle('Burger');
        $cat3->setActive(1);
        $cat3->setImage('burger_cat.jpg');


        $manager->flush();
    }
}
