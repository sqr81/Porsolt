<?php
namespace App\Controller;

use App\Entity\Etude;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArrowController  extends AbstractController
{

    /**
     * @Route("/arrow/arrowEtude")
     * @param Etude $etude
     * @return Response
     */
    public function arrowEtude(Etude $etude)
    {

        return $this->render('arrow/arrowEtude.html.twig', [
            'etude' => $etude,



        ]);
    }

    /**
     * @Route("/arrow/arrowPrelevement")
     * @param Etude $etude
     * @return Response
     */
    public function arrowPrelevement(Etude $etude)
    {

        return $this->render('/arrow/arrowPrelevement.html.twig', [
            'etude' => $etude,

        ]);
    }

    /**
     * @Route("/arrow/arrowTemps")
     * @param Etude $etude
     * @return Response
     */
    public function arrowTemps(Etude $etude)
    {

        return $this->render('/arrow/arrowTemps.html.twig', [
            'etude' => $etude,

        ]);
    }
}

