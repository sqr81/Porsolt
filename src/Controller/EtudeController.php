<?php
namespace App\Controller;

use App\Entity\Etude;
use App\Repository\EtudeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  EtudeController extends AbstractController
{
    /**
     * @var EtudeRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(EtudeRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
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
        ->setEspeceAnimale(1)
        ->setStatut(2)
        ->setCommentaire('bla bla');

        $em = $this->getDoctrine()->getManager();
        $em->persist($etude);
        $em->flush();
        */
        $etudes = $this->repository->findAll();
        $this->em->flush();
        return $this->render('etude/index.html.twig', [
            'etudes' => $etudes

        ]);
    }

    /**
     * @param EtudeRepository $repository
     * @return Response
     */
    public function lastEtudes(EtudeRepository $repository): Response
    {
        /*$form = $this->createFormBuilder()
        ->add('numero', TextType::class)
        ->getForm();*/
        $etudes = $repository->findLatest();
        return $this->render('etude/index.html.twig', [
            'etudes' => $etudes,
            'current_menu' => 'etudes'
        ]);
    }

    /**
     * @Route("/etudes/{slug}-{id}", name="etude.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Etude $etude
     * @param string $slug
     * @return Response
     */
    public function show(Etude $etude, string $slug): Response
    {
        if ($etude->getSlug() !== $slug) {
            return $this->redirectToRoute('etude.show', [
                'id' => $etude->getId(),
                'slug' => $etude->getSlug()
            ], 301);
        }
        return $this->render('etude/show.html.twig', [
            'etude' => $etude,
            'current_menu' => 'etudes'
        ]);
    }
}