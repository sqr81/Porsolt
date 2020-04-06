<?php
namespace App\Controller\Admin;
use App\Entity\Groupe;
use App\Entity\Produit;
use App\Form\GroupeType;
use App\Repository\GroupeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @Route("/groupe/show", name="groupe.index")
     * @return Response
     */
    public function index(): Response
    {
        /* creation nouvelle entite
       $groupe = new Groupe();
       $groupe->setIntitule('A')
       ->setIdAnimalPorsolt('A1')
       ->setNomUsuel('Dog1')
       ->setPuce('5544854')
       ->setNbreAnimaux('10')
       $em = $this->getDoctrine()->getManager();
       $em->persist($groupe);
       $em->flush();*/


        $groupes = $this->repository->findAll();
        $produits = $this->repository->findAll();
        $this->em->flush();
        return $this->render('/groupe/show.html.twig', [
            'groupes' => $groupes,
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/admin/groupe/new", name="admin.groupe.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($groupe);
            $this->em->flush();
            return $this->redirectToRoute('groupe.show');
        }

        return $this->render('admin/groupe/new.html.twig',[
            'groupe' => $groupe,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/groupe/{slug}-{id}", name="groupe.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Groupe $groupe
     * @param string $slug
     * @param Produit $produit
     * @return Response
     */
    public function show(Groupe $groupe, string $slug, Produit $produit): Response
    {
        $groupes = $this->repository->findAll();
        if ($groupe->getSlug() !== $slug) {
            return $this->redirectToRoute('groupe.show', [
                'id' => $groupe->getId(),
                'slug' => $groupe->getSlug()
            ], 301);
        }
        return $this->render('groupe/show.html.twig', [
            'groupes' => $groupes,
            'groupe' => $groupe,
            'produit' => $produit

        ]);
    }



}