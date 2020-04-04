<?php
namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProduitController extends AbstractController
{
    /**
     * @var ProduitRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ProduitRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/produit", name="admin.produit.index")
     * @return Response
     */
    public function index()
    {
        $produits = $this->repository->findAll();
        return $this->render('admin/produit/index.html.twig', compact('produits'));

    }

    /**
     * @Route("/admin/produit/create", name="admin.produit.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $produit= new Produit();

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($produit);

            $this->em->flush();
            return $this->redirectToRoute('admin.produit.index');
        }
        return $this->render('admin/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produit/{id}", name="admin.produit.edit")
     * @param Produit $produit
     * @param Etude $etude
     * @param Request $request
     * @return Response
     */
    public function edit(Produit $produit, Etude $etude, Request $request)
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.produit.index');
        }
        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'etude' => $etude,
            'form' => $form->createView()
        ]);
    }
}
