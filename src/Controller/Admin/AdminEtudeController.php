<?php
namespace App\Controller\Admin;


use App\Entity\Etude;
use App\Entity\Produit;
use App\Form\EtudeType;
use App\Repository\EtudeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEtudeController extends AbstractController
{
    /**
     * @var EtudeRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EtudeRepository $repository, EntityManagerInterface $em)
    {
    $this->repository = $repository;
    $this->em =$em;
    }

    /**
     * @Route("/etudes", name="etude.index")
     * @return Response
     */
    public function index(): Response
    {
        /* creation nouvelle entite
        $etude = new Etude();
        $etude->setNumero('200001')
        ->setSponsor('Bayer')
        ->setTestType('PK')
        ->setDe('FDV')
        ->setRepresentantSponsor('BYR')
        ->setTre('DSV')
        ->setCommercial('AZE')
        ->setEspeceAnimale('rat')
        ->setStatut('en cours')
        ->setCommentaire('bla bla');

        $em = $this->getDoctrine()->getManager();
        $em->persist($etude);
        /*$em->flush();*/

        $etudes = $this->repository->findAll();
        $this->em->flush();
        return $this->render('etude/index.html.twig', [
            'etudes' => $etudes

        ]);
    }

    /* ----création nouvelle étude-----*/
    /**
     * @Route("/admin/etude/new", name="admin.etude.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $etude = new Etude();
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($etude);
            $this->em->flush();
            return $this->redirectToRoute('etude.index');
        }

        return $this->render('admin/etude/new.html.twig',[
            'etude' => $etude,
            'form' => $form->createView()
        ]);
    }

    /* ------supprimer une étude ------*/
    /**
     * @Route("/admin/etude/{id}", name="admin.etude.delete", methods="DELETE")
     * @param Etude $etude
     * @return RedirectResponse
     */
    public function delete(Etude $etude, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' .$etude->getId(), $request->get('_token') )) {
            $this->em->remove($etude);
            $this->addFlash('success', 'Suppression effectuée');/*egalement a afficher dans la vue*/
            $this->em->flush();
        }
        return $this->redirectToRoute('etude.index');
    }

    /* ----détail d'une étude-----*/
    /**
     * @Route("/etudes/{slug}-{id}", name="etude.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Etude $etude
     * @param string $slug
     * @param ProduitRepository $repository
     * @return Response
     */
    public function show(Etude $etude, string $slug, ProduitRepository $repository): Response
    {
        if ($etude->getSlug() !== $slug) {
            return $this->redirectToRoute('etude.show', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }

        $produit = new produit;
        return $this->render('etude/show.html.twig', [
            'etude' => $etude,
            'produit' => $produit,
            'id' => $etude->getId(),
            'slug' => $etude->getSlug()

        ]);
    }

}