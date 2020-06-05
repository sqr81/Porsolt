<?php

namespace App\DataFixtures;

use App\Entity\TempsPrelevement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TempsPrelevementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $temps = new TempsPrelevement();
        $temps->setTempsPrelevement('8 h');
        $temps->setDataCheckBox([1]);
        $manager->persist($temps);
        $manager->flush();
    }
}
