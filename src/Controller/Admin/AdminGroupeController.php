<?php
namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Produit;
use App\Form\GroupeType;
use App\Repository\EtudeRepository;
use App\Repository\GroupeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminGroupeController extends AbstractController
{

    /**
     * @Var GroupeRepository
     *
     */
    private $repository;
    /**
     * @param EntityManagerInterface
     */
    private $em;

    public function __construct(GroupeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em=$em;
    }

//    /**
//     * @Route("/groupe/show", name="groupe.index")
//     * @return Response
//     */
//    public function index(): Response
//    {
//        /* creation nouvelle entite
//       $groupe = new Groupe();
//       $groupe->setIntitule('C')
//       ->setIdAnimalPorsolt('C1')
//       ->setNomUsuel('Dog1')
//       ->setPuce('554485')
//       ->setNbreAnimaux('10');
//       $em = $this->getDoctrine()->getManager();
//       $em->persist($groupe);
//       $em->flush();*/
//
//
//        $groupes = $this->repository->findAll();
//        $produits = $this->repository->findAll();
//        $this->em->flush();
//        return $this->render('/groupe/show.html.twig', [
//            'groupes' => $groupes,
//            'produits' => $produits
//        ]);
//    }


//    /**
//     * @Route("/groupe/index", name="groupe.index")
//     * @return Response
//     */
//    public function index(): Response
//    {
//        $groupes = $this->repository->findAll();
//        $produits = $this->repository->findAll();
//        $etude = new Etude();
//        $produit = new Produit();
////        $this->em->flush();
////        dump($groupes, $produit);
////        die();
//
//        return $this->render('/groupe/index.html.twig', [
//            'groupes' => $groupes,
//            'produits' => $produits,
//            'produit' => $produit,
//            'etude' => $etude,
//        ]);
//
//    }

    /**
     * @Route("/groupe/index/{slug}-{id}", name="groupe.index", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Produit $produit
     * @return Response
     */
    public function index(string $slug, Produit $produit): Response
    {
        $etudes = $this->repository->findAll();
        $groupes = $this->repository->findAll();

        if ($produit->getSlug() !== $slug) {
            return $this->redirectToRoute('groupe.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }
        //renvoit l etude dans l arrow
        $etude = $produit->getEtude();//----//
        $groupe = new Groupe();
        return $this->render('groupe/index.html.twig', [

            'produit' => $produit,
            'etude' => $etude,
            'groupe' => $groupe,
            'groupes' => $groupes,
            'etudes' => $etudes,

        ]);


    }


    /**
     * @Route("/groupe/show/{slug}-{id}", name="groupe.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Produit $produit
     * @param string $slug
     * @return Response
     */
    public function show(string $slug, Produit $produit): Response
    {
//        $groupes = $this->repository->findAll();
//        $produits = $this->repository->findAll();
        if ($produit->getSlug() !== $slug) {
            return $this->redirectToRoute('groupe.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }
        //renvoi l etude dans l arrow
        $etude = $produit->getEtude();//----/
        return $this->render('groupe/show.html.twig', [
            //'groupes' => $groupes,
            'produit' => $produit,
            //'produits' => $produits
            'etude' => $etude,


        ]);


    }

    /**
     * @Route("/admin/groupe/new", name="admin.groupe.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()) {
            $produit = $this->getDoctrine()->getManager()->getRepository('App:Produit')->find($request->request->get('groupe')['groupeId']);

//            dump($produit);
//            die();
            $nom=$form['idAnimalPorsolt']->getData();       /*comparaison groupe avec produit*/
            if ($this->groupeNameExist($produit, $nom)){
//                dump($groupe, $produit);
//                die();
                $this->addFlash('success', 'Id animal Porsolt déjà éxistant');
                                       /*message error + return */
                return $this->render('admin/groupe/new.html.twig',[
                    'groupe' => $groupe,
                    'form' => $form->createView()
                ]);

            }

            $groupe->setProduit($produit);
            $this->em->persist($groupe);
            $this->em->flush();

            return $this->redirectToRoute('groupe.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug(),
            ], 301);
        }
        return $this->render('admin/groupe/new.html.twig',[
            'groupe' => $groupe,
            'form' => $form->createView()
        ]);
    }

    /**
     * fonction pour comparer un groupe avec un  produit existant
     * @param Produit $produit
     * @param $nom
     * @return bool
     */
    public function groupeNameExist (Produit $produit, $nom)
    {
        foreach ($produit->getGroupes()as $groupe){
            if ($groupe->getIdAnimalPorsolt()===$nom){
                return true;
            }
        }
    }

}