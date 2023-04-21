<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Detail;
use App\Entity\Plat;
use App\Entity\Utilisateur;
use ContainerXkERt5Y\getSecurity_UserPasswordHasherService;
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
        $plat3->setImage('pizza-margherita.jpg');
        $plat3->setActive(1);
        $plat3->setCategorie($cat1);
        $manager->persist($plat3);

        $plat4 = new Plat();
        $plat4->setLibelle('Pizza saumon');
        $plat4->setDescription('Pizza aux saumon');
        $plat4->setPrix(19);
        $plat4->setImage('pizza-salmon.png');
        $plat4->setActive(1);
        $plat4->setCategorie($cat1);
        $manager->persist($plat4);

        $plat5 = new Plat();
        $plat5->setLibelle('Spaghetti aux legumes');
        $plat5->setDescription('Pâtes fraiches aux légumes spécialement choisie par le chef');
        $plat5->setPrix(12.99);
        $plat5->setImage('spaghetti-legumes.jpg');
        $plat5->setActive(1);
        $plat5->setCategorie($cat2);
        $manager->persist($plat5);

        // Commandes

        $com1 = new Commande();
        $com1->setDateCommande(new \DateTimeImmutable('16-04-2023 14:06:12'))
            ->setTotal('24')
            ->setEtat('2');
        $manager->persist($com1);

        $com2 = new Commande();
        $com2->setDateCommande(new \DateTimeImmutable('16-04-2023 14:06:12'))
            ->setTotal('15')
            ->setEtat('1');
        $manager->persist($com2);

        $com3 = new Commande();
        $com3->setDateCommande(new \DateTimeImmutable('16-04-2023 14:06:12'))
            ->setTotal('19')
            ->setEtat('0');
        $manager->persist($com3);

        // Users

        $admin = new Utilisateur();
        $admin->setEmail('admin@admin.fr')
            ->setNom('Fleur')
            ->setPrenom('Geoffrey')
            ->setTelephone('0645785421')
            ->setPassword(password_hash('bonjour', PASSWORD_DEFAULT))
            ->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $manager->persist($admin);

        $user1 = new Utilisateur();
        $user1->setEmail('romain@gmail.com')
            ->setNom('Durand')
            ->setPrenom('Romain')
            ->setTelephone('0678521545')
            ->setPassword(password_hash('bonjour', PASSWORD_DEFAULT))
            ->setRoles(['ROLE_USER'])
            ->addCommande($com1);
        $manager->persist($user1);

        $user2 = new Utilisateur();
        $user2->setEmail('durand@gmail.com')
            ->setNom('Gatand')
            ->setPrenom('Julien')
            ->setTelephone('0678565415')
            ->setPassword(password_hash('bonjour', PASSWORD_DEFAULT))
            ->setRoles(['ROLE_USER'])
            ->addCommande($com2)
            ->addCommande($com3);
        $manager->persist($user2);

        // Détails

        $det1 = new Detail();
        $det1->setCommande($com1)
            ->setPlat($plat3)
            ->setQuantite(3);
        $manager->persist($det1);

        $det2 = new Detail();
        $det2->setCommande($com2)
            ->setPlat($plat2)
            ->setQuantite(1);
        $manager->persist($det2);

        $det3 = new Detail();
        $det3->setCommande($com3)
            ->setPlat($plat5)
            ->setQuantite(5);
        $manager->persist($det3);

        $manager->flush();
    }
}
