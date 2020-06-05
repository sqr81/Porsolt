<?php

namespace App\DataFixtures;

use App\Entity\Prelevement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PrelevementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
$prelevement = new Prelevement();
        $prelevement->setTypePrelevement('sang');
        $prelevement->setTypePrelevement('csf');
        $prelevement->setTypePrelevement('cerveau');
        $prelevement->setTypePrelevement('foie');
        $prelevement->setTypePrelevement('coeur');
        $prelevement->setTypePrelevement('formulations');
        $prelevement->setTypePrelevement('urine');
        $prelevement->setTypePrelevement('fécès');
        $prelevement->setTypePrelevement('autres');
        $manager->persist($prelevement);
        $manager->flush();
    }
}
