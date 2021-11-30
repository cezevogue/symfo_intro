<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Préfixe de route défini sur la classe:
 * toutes les url des routes définies seront préfixées de /twig dans ce controller
 *
 * @Route("/twig")
 */
class TwigController extends AbstractController
{
    /**
     * on accède à cette méthode via /twig ou /twig/
     *
     * @Route("/", name="twig")
     */
    public function index(): Response
    {
        return $this->render('twig/index.html.twig', [

            'demain'=>new \DateTime('+1day')
        ]);
    }
}
