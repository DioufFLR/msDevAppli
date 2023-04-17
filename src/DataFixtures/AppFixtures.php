<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Plat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Catégories

        $cat1 = new Categorie();
        $cat1->setLibelle('Pizza');
        $cat1->setActive(1);
        $cat1->setImage('pizza_cat.jpg');
        $manager->persist($cat1);

        $cat2 = new Categorie();
        $cat2->setLibelle('Pâtes');
        $cat2->setActive(1);
        $cat2->setImage('pasta_cat.jpg');
        $manager->persist($cat2);

        $cat3 = new Categorie();
        $cat3->setLibelle('Burger');
        $cat3->setActive(1);
        $cat3->setImage('burger_cat.jpg');
        $manager->persist($cat3);

        // Plats

        $plat1 = new Plat();
        $plat1->setLibelle('Cheeseburger');
        $plat1->setDescription('Burger classic steack cheddar et cornichons');
        $plat1->setPrix(5.99);
        $plat1->setImage('cheeseburger.jpg');
        $plat1->setActive(1);
        $plat1->setCategorie($cat3);
        $manager->persist($plat1);

        $plat2 = new Plat();
        $plat2->setLibelle('Hamburger');
        $plat2->setDescription('Burger classic steack cheddar et cornichons et double fromage');
        $plat2->setPrix(7);
        $plat2->setImage('hamburger.jpg');
        $plat2->setActive(1);
        $plat2->setCategorie($cat3);
        $manager->persist($plat2);

        $plat3 = new Plat();
        $plat3->setLibelle('Pizza margherita');
        $plat3->setDescription('Pizza jambon fromage et champignon sur base sauce tomate');
        $plat3->setPrix(15);
        $plat3->setImage('pizza_margherita.jpg');
        $plat3->setActive(1);
        $plat3->setCategorie($cat1);
        $manager->persist($plat3);

        $plat4 = new Plat();
        $plat4->setLibelle('Pizza saumon');
        $plat4->setDescription('Pizza aux saumon');
        $plat4->setPrix(19);
        $plat4->setImage('pizza_salmon.png');
        $plat4->setActive(1);
        $plat4->setCategorie($cat1);
        $manager->persist($plat4);

        $plat5 = new Plat();
        $plat5->setLibelle('Spaghetti aux legumes');
        $plat5->setDescription('Pâtes fraiches aux légumes spécialement choisie par le chef');
        $plat5->setPrix(12.99);
        $plat5->setImage('spaghetti_legumes.jpg');
        $plat5->setActive(1);
        $plat5->setCategorie($cat2);
        $manager->persist($plat5);

        // Commandes

        // Users

        $manager->flush();
    }
}
