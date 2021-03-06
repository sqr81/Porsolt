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
use PDO;
use phpDocumentor\Reflection\Types\String_;
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
     * @var Produit
     */
    private $produit;


    /*--------temps existants----------*/
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
        /*----ajout de temps----*/
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



        return $this->render('temps/index.html.twig', [
            'produit' => $produit,
            'etude' => $etude,
            'produits' => $produits,
            'tempss' => $tempss,
            'form' => $form->createView()

        ]);
    }

    /*--------temps existants pour chaque produit ----------*/
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

    /**
     * @Route("/temps/index/{slug}-{id}/{produit}/insert", name="dataCheckBox.insert", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Etude $etude
     * @param Produit $produit
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function dataCheckBoxInsert(string $slug, Etude $etude, Produit $produit, Request $request,EntityManagerInterface $em): Response
    {

    }


    /*-----------nouveau temps pour les groupes----------*/
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

    /*-------supprimer un temps-----*/
    /**
     * @Route("/temps/delete/{id}", name="temps.delete", requirements={"slug": "[a-z0-9\-]*"})
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

//        return $this->redirectToRoute('temps.index'
//        , [
//                'id' => $temps->getId(),
//                'slug' => $etude->getSlug()
//        ], 301);
    }

    /*------------ cocher les checkbox liées aux temps---------------*/
    /**
     * @Route("/datacheckbox", name="datacheckbox.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function dataCheckBox(Request $request,EntityManagerInterface $em):Response
    {
        if(isset($_POST['submit'])){
            if(!empty($_POST['check_list'])) {
// Counting number of checked checkboxes.
                $checked_count = count($_POST['check_list']);
                echo "Vous avez selectionné ".$checked_count." option(s)temps: <br/>";
// Loop to store and display values of individual checked checkbox.
                foreach($_POST['check_list'] as $selected) {
                    echo "<p>".$selected ."</p>";
                    $temps = new TempsPrelevement();
                    $temps->setTempsPrelevement($selected);
                    if(isset($selected)){
                        echo 'La variable selected est définie' . '<br />';}
                    $this->em->persist($temps);
                    $this->em->flush();
                }
            }
            else{
                echo "<b>Veuillez selectionner au moins 1 option.</b>";
            }
        }
        return $this->redirectToRoute("datacheckbox.newTime");
    }

    /*----------rajoute un temps sur la page check box------------*/
    /**
     * @Route("/datacheckbox/newTime", name="datacheckbox.newTime")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function dataCheckBoxNewTemps (Request $request,EntityManagerInterface $em):Response
    {

        $tempss = $this->TempsPrelevementRepository->findAll();

        $temps = new TempsPrelevement();
        $form = $this->createForm(TempsPrelevementType::class, $temps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($temps);
            $this->em->flush();

            return $this->redirectToRoute('datacheckbox.newTime');
        }
        //renvoi l etude dans l arrow
//        $etude = $produit->getEtude();//----//
        return $this->render('/dataCheckBox/dataCheckBox.html.twig', [
            'temps' => $temps,
            'tempss' => $tempss,
//            'etude' => $etude,
//            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

}