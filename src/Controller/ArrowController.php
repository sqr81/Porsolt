<?php
namespace App\Controller;

use App\Entity\Etude;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ArrowController  extends AbstractController
{

    /**
     * @Route("/pages/arrow")
     * @param Etude $etude
     * @return Response
     */
    public function arrow(Etude $etude)
    {

        return $this->render('pages/arrow.html.twig', [
            'etude' => $etude,


        ]);
    }
}

