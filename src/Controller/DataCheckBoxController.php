<?php
namespace App\Controller;

use App\Entity\Etude;
use App\Repository\ProduitRepository;
use App\Repository\TempsPrelevementRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  DataCheckBoxController extends AbstractController
{
    /**
     * @var TempsPrelevementRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(TempsPrelevementRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;

    }


}