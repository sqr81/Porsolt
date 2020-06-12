<?php
namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Prelevement;
use App\Entity\Produit;
use App\Form\EtudeType;
use App\Form\PrelevementType;
use App\Repository\EtudeRepository;
use App\Repository\PrelevementRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;


class AdminPrelevementController extends AbstractController
{
    public function __construct(PrelevementRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em =$em;
    }

    /**
     * @var PrelevementRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;


    /*------presentation des prelevements existants--------*/
    /**
     * @Route("/prelevement/index/{slug}-{id}", name="prelevement.index", requirements={"slug": "[a-z0-9\-]*"})
     * @param string $slug
     * @param Etude $etude
     * @param Produit $produit
     * @return Response
     */
    public function index(string $slug, Etude $etude): Response
    {
        $prelevements = $this->repository->findAll();
        if ($etude->getSlug() !== $slug) {
            return $this->redirectToRoute('etude.show', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }
//        renvoi l etude dans l arrow
//        $etude = $produit->getEtude();

        return $this->render('prelevement/index.html.twig', [
//          'produit' => $produit,
            'etude' => $etude,
            'prelevements' => $prelevements,

        ]);
    }
    /*----------nouveau prelevement------------*/
    /**
     * @Route("/prelevement/index/{slug}-{id}", name="prelevement.index", requirements={"slug": "[a-z0-9\-]*"})
     * @param Request $request
     * @param Etude $etude
     * @return RedirectResponse|Response
     */
    public function new(Request $request, Etude $etude): Response
    {
        $prelevements = $this->repository->findAll();
        $prelevement = new Prelevement();
        $form = $this->createForm(PrelevementType::class, $prelevement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($prelevement);
            $this->em->flush();

            return $this->redirectToRoute('prelevement.index', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }
        //        renvoi l etude dans l arrow
        //        $etude = $produit->getEtude();
        return $this->render('prelevement/index.html.twig',[
            'prelevement' => $prelevement,
            'prelevements' => $prelevements,
            'etude' => $etude,
            'form' => $form->createView()
        ]);
    }

}