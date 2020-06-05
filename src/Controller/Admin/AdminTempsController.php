<?php
namespace App\Controller\Admin;

use App\Controller\DataCheckBoxController;
use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Produit;
use App\Entity\TempsPrelevement;
use App\Form\TempsPrelevementType;
use App\Repository\EtudeRepository;
use App\Repository\ProduitRepository;
use App\Repository\TempsPrelevementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTempsController extends AbstractController
{



    public function __construct(TempsPrelevementRepository $repository, EntityManagerInterface $em)
    {
        $this->TempsPrelevementRepository = $repository;
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @var ProduitRepository
     */
    private $ProduitRepository;
    /**
     * @var TempsPrelevementRepository
     */
    private $TempsPrelevementRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ProduitRepository
     */
    private $repository;


    /**
     * @Route("/temps/index/{slug}-{id}", name="temps.index", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Etude $etude
     * @param ProduitRepository $produits
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(string $slug, Etude $etude, ProduitRepository $produits, Request $request,EntityManagerInterface $em): Response
    {
        $tempss = $this->TempsPrelevementRepository->findAll();    /*checkbox*/


        $temps = new TempsPrelevement();
        $form = $this->createForm(TempsPrelevementType::class, $temps);
        $form->handleRequest($request);

        if ($etude->getSlug() !== $slug) {
            return $this->redirectToRoute('prelevement.index', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }



//        $quest = $request->request->all();
//
//        foreach($quest as $prop=>$qst){
//            $reponse= new Reponse();
//            $reponse->setIdQuestion($qst);
//            $reponse->setIdProposition($prop);
//            $reponse->setCreatedAt(new \DateTime());
//            $manager->persist($reponse);
//            $manager->flush();

        foreach ($tempss as $produits => $qst) {
            $dataCheckBox = new ();
            $dataCheckBox->setDataCheckBox((array)$qst);
//            $reponse->setIdProposition($prop);
            dump($dataCheckBox);
            die();
            $em->persist($dataCheckBox);
            $em->flush();
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($temps);
            $this->em->flush();

            return $this->redirectToRoute('temps.index', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }
        $produit = new Produit();
//        //renvoi l etude dans l arrow
//        $etude = $produit->getEtude();//----//
        $produits->findAll();

        $quest = $request->request->all();


        return $this->render('temps/index.html.twig', [
            'produit' => $produit,
            'etude' => $etude,
            'produits' => $produits,
            'tempss' => $tempss,
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/temps/show/{slug}-{id}", name="temps.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Etude $etude
     * @param Produit $produit
     * @return Response
     */
    public function show(string $slug, Produit $produit): Response
    {

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

//    /**
//     * @Route("/temps/index/{slug}-{id}", name="temps.new", requirements={"slug": "[a-z0-9\-]*"})
//     * @param Request $request
//     * @param Etude $etude
//     * @param string $slug
//     * @return RedirectResponse|Response
//     */
//    public function new(Request $request, Etude $etude, string $slug): Response
//    {
//
//        $tempss = $this->TempsPrelevementRepository->findAll();
//        $temps = new TempsPrelevement();
//        $form = $this->createForm(TempsPrelevementType::class, $temps);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $this->em->persist($temps);
//            $this->em->flush();
//
//            return $this->redirectToRoute('temps.index', [
//                'id' => $etude->getId(),
//                'slug' => $etude->getSlug()
//            ], 301);
//        }
//
////        $etude = $produit->getEtude();
//
//        return $this->render('temps/index.html.twig', [
//            'temps' => $temps,
//            'tempss' => $tempss,
//            'etude' => $etude,
//            'form' => $form->createView()
//        ]);
//    }

    /**
     * @Route("/temps/show/{slug}-{id}", name="temps.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Request $request
     * @param string $slug
     * @param Produit $produit
     * @return Response
     */
    public function newTempsForGroupe(Request $request, string $slug, Produit $produit): Response
    {
        $tempss = $this->TempsPrelevementRepository->findAll();

        $temps = new TempsPrelevement();
        $form = $this->createForm(TempsPrelevementType::class, $temps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($temps);
            $this->em->flush();

            return $this->redirectToRoute('temps.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }
        //renvoi l etude dans l arrow
        $etude = $produit->getEtude();//----//

        return $this->render('temps/show.html.twig', [
            'temps' => $temps,
            'tempss' => $tempss,
            'etude' => $etude,
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/temps/index/{id}", name="temps.delete", requirements={"slug": "[a-z0-9\-]*"})
     * @param TempsPrelevement $temps
     * @param Etude $etude
     * @return Response
     */
    public function delete(TempsPrelevement $temps)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($temps);
        $this->addFlash('success', 'Suppression effectuée');/*egalement a afficher dans la vue*/
        $em->flush();


        return new Response('suppression effectuée');



//        return $this->redirectToRoute('temps.index', [
//            'id' => $etude->getId(),
//            'slug' => $etude->getSlug()
//        ], 301);
    }


}
