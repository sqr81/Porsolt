<?php
namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Produit;
use App\Form\EtudeType;
use App\Form\FicheAnimalType;
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
    /**
     * @var ProduitRepository
     */
    private $produitRepository;
    private $getDoctrine;

    public function __construct(GroupeRepository $repository, EntityManagerInterface $em, ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->repository = $repository;
        $this->em=$em;
    }

    /*-----------liste des études-------------*/
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

    /*--------détail des études----------*/
    /**
     * @Route("/groupe/show/{slug}-{id}", name="groupe.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Produit $produit
     * @param string $slug
     * @return Response
     */
    public function show(string $slug, Produit $produit): Response
    {
        if ($produit->getSlug() !== $slug) {
            return $this->redirectToRoute('groupe.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug()
            ], 301);
        }
        //renvoi l etude dans l arrow
        $etude = $produit->getEtude();//----/

        return $this->render('groupe/show.html.twig', [
            'produit' => $produit,
            'etude' => $etude,
        ]);
    }

    /*----------- création d'un groupe(produit dans bdd)-----------*/
    /**
     * @Route("/admin/{id}/groupe/new/", name="admin.groupe.new")
     * @param Request $request
     * @param Produit $produit
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request, Produit $produit)
    {
        $groupe = new Groupe();
        $form = $this->createForm(FicheAnimalType::class, $groupe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $idAnimalPorsoltToCompare = $form->get('idAnimalPorsolt')->getData();
            if ($this->groupeNameExist($produit, $idAnimalPorsoltToCompare))  /*fiche animal unique dans produit*/
            {
                $this->addFlash('danger', 'Id animal Porsolt déjà éxistant');   /*message si id animal existe deja*/
                return $this->redirectToRoute('groupe.show', [
                    'id' => $produit->getId(),
                    'slug' => $produit->getSlug(),
                ], 301);
            }
            $groupe->setProduit($produit);
            $groupe->setIntitule($produit->getGroupe());
            $this->em->persist($groupe);
            $this->em->flush();
            return $this->redirectToRoute('groupe.show', [
                'id' => $produit->getId(),
                'slug' => $produit->getSlug(),
            ], 301);
        }
        return $this->render('admin/groupe/new.html.twig',[
            'id' => $produit->getId(),
            'slug' => $produit->getSlug(),
            'produit' => $produit,
            'groupe' => $groupe,
            'form' => $form->createView()
        ]);
    }

    /*-----fonction pour comparer un groupe avec un  produit existant-----*/
    /**
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