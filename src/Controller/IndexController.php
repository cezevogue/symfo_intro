<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * Annotation de route: definiti quel est l'url sur lequel
     * on accède à la méthode.
     * Si on ne nomme pas une route, celle-ci sera appelé par défaut
     * par app_  suivi du nom du controller suivi du nom de la méthode appelée
     * ici app_index_index
     *
     *
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        // la vue (= html) de la page de cette méthode est généré  par le template contenu dans index/index.html.twig
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * Partie variable de l'url entre accolade:
     * La route /hello/cesaire ou /hello/didier matchent tout deux
     *
     * le $qui en argument de la méthode contient la valeur de la partie variable
     * {qui}
     *
     * le nom de la route est app_index_hello
     *
     * les url et nom de route doivent être imperativement entre "" et non ''
     *
     * @Route("/hello/{qui}")
     */
    public function hello($qui)
    {

        // ici on passe à notre vue une variable 'nom' qui a pour valeur $qui
        return $this->render('index/hello.html.twig',[
            'nom'=>$qui
        ]);
    }

    /**
     * @Route("/salut/{qui}", defaults={"qui": "à toi"})
     *
     *  les routes /salut/cesaire et /salut fonctionnent toutes deux
     * en l'absence de valeur de {qui} il prendra la valeur par défaut 'à toi'
     */
    public function salut($qui)
    {

        return $this->render('index/salut.html.twig', [
            'nom'=>$qui
        ]);
    }

    /**
     * ici une route avec 2 parties variables dont une optionnelle
     *
     * @Route("/coucou/{prenom}/{nom}", defaults={"nom": ""})
     */
    public function coucou($prenom, $nom)
    {

        $nomComplet=rtrim($prenom.' '.$nom);

        return $this->render("index/coucou.html.twig",[
            'nom'=>$nomComplet
        ]);
    }

    /**
     * on impose par l'expression réguliere \d+ que l'id soit un nombre
     *
     * @Route("/edit/{id}", requirements={"id":"\d+"})
     */
    public function edit($id)
    {
        return $this->render('index/edit.html.twig',[

            'id'=>$id
        ]);
    }


}
