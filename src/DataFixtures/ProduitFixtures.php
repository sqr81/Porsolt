<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $produit = new Produit();
        $produit->setGroupe('A');
        $produit->setIdProduitPorsolt('AZ267');
        $produit->setNbreAnimaux('10');
        $produit->setVoieAdmin('ip');
        $produit->setDatePremierPrelevement(new\DateTime("2019-06-07"));
        $produit->setCommentaire('bla bla bla');

            $manager->persist($produit);
            $manager->flush();
    }
}
