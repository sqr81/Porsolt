<?php
namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Produit;
use App\Form\EtudeType;
use App\Repository\EtudeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPrelevementController extends AbstractController
{
//    /**
//     * @Route("/prelevement/index/{slug}-{id}", name="prelevement.index", requirements={"slug": "[a-z0-9\-]*"})
//     * @param string $slug
//     * @param Produit $produit
//     * @return Response
//     */
//    public function index(string $slug, Produit $produit): Response
//    {
////        $etudes = $this->repository->findAll();
////        $groupes = $this->repository->findAll();
//
//        if ($produit->getSlug() !== $slug) {
//            return $this->redirectToRoute('etude.show', [
//                'id' => $produit->getId(),
//                'slug' => $produit->getSlug()
//            ], 301);
//        }
//
//        $etude = new Etude();
//        $groupe = new Groupe();
//        return $this->render('prelevement/index.html.twig', [
//
//            'produit' => $produit,
//            'etude' => $etude,
//            'groupe' => $groupe,
//
//
//        ]);
//
//
//    }


    /**
     * @Route("/prelevement/index/{slug}-{id}", name="prelevement.index", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Etude $etude
     * @param Produit $produit
     * @return Response
     */
    public function index(string $slug, Etude $etude): Response
    {
        //        $groupes = $this->repository->findAll();

        if ($etude->getSlug() !== $slug) {

            return $this->redirectToRoute('etude.show', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }
        //renvoi l etude dans l arrow
//        $etude = $produit->getEtude();
        //
        return $this->render('prelevement/index.html.twig', [
//          'produit' => $produit,
            'etude' => $etude,
        ]);
    }
}