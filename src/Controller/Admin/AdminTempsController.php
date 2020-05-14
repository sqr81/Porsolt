<?php
namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Produit;
use App\Repository\EtudeRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTempsController extends AbstractController
{

//    /**
//     * @Route("/temps/index", name="temps.index")
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function index()
//    {
//        $produit =  new Produit();
//        //renvoi l etude dans l arrow
//        $etude = $produit->getEtude();//----//
//
//        return $this->render('/temps/index.html.twig', [
//            'etude' => $etude,
//            'produit'=> $produit,
//        ]);
//
//    }
    /**
     * @var ProduitRepository
     */
    private $repository;

    /**
     * @Route("/temps/index/{slug}-{id}", name="temps.index", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Etude $etude
     * @param ProduitRepository $produits
     * @return Response
     */
    public function index(string $slug, Etude $etude, ProduitRepository $produits): Response
    {
        //$groupes = $this->repository->findAll();

        //$etude = new Etude();
        if ($etude->getSlug() !== $slug) {

            return $this->redirectToRoute('prelevement.index', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }

        $produit = new Produit();
//        //renvoi l etude dans l arrow
//        $etude = $produit->getEtude();//----//
        $produits->findAll();
        return $this->render('temps/index.html.twig', [
            //'groupes' => $groupes,
            'produit' => $produit,
            //'produits' => $produits
            'etude' => $etude,
            'produits' =>$produits,

        ]);
    }
//    /**
//     * @Route("/temps/show", name="temps.show")
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function show()
//    {
//        $etude = new Etude();
//        $produit =  new Produit();
//        return $this->render('/temps/show.html.twig', [
//            'etude' => $etude,
//            'produit'=> $produit,
//        ]);
//
//    }

    /**
     * @Route("/temps/show/{slug}-{id}", name="temps.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Etude $etude
     * @param Produit $produit
     * @return Response
     */
    public function show(string $slug, Produit $produit): Response
    {
        //        $groupes = $this->repository->findAll();

        $etude = new Etude();
        if ($produit->getSlug() !== $slug) {


            return $this->redirectToRoute('prelevement.index', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }


        //renvoi l etude dans l arrow
        $etude = $produit->getEtude();//----//
        return $this->render('/temps/show.html.twig', [
            //'groupes' => $groupes,
            'etude' => $etude,
            'produit' => $produit,
            //'produits' => $produits,



        ]);
    }



}