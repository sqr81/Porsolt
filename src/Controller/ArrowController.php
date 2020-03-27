<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ArrowController  extends AbstractController
{

    /**
     * @Route("/pages/arrow")
     */
    public function arrow()
    {
        return $this->render('pages/arrow.html.twig');
    }
}

