<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/base")
 */
class BaseController extends AbstractController
{
    /**
     * @Route("/base", name="base")
     */
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    /**
     * @Route("/requete")
     */
    public function requete(Request $request) // ici on injecte la dépendance Request instancié dans l'objet $request ( de HttpFoundation)
    {
        // Request permet de récupérer nos SUPERGLOBALES
        dump($request);
        //https://127.0.0.1:8000/base/requete?nom=doe&prenom=john
        dump($_GET);
        //array:2 [▼
//        "nom" => "doe"
//  "prenom" => "john"
//]
        // $request->query contient un objet qui est une surcouche de $_GET
        //dd($request->query->all());
        //array:2 [▼
//        "nom" => "doe"
//  "prenom" => "john"
//]

        // echo $_GET['prenom']
        echo $request->query->get('prenom');


        // isset($_GET['surnom'])
        dump($request->query->has('surnom'));// false

        dump($request->query->get('surnom', 'toto'));// valeur par defaut, renvoi toto

        echo '<br>' . $request->getMethod();// renvoie la méthode utilisée (GET ou POST)

        if ($request->isMethod('POST')):
            // $request->request contient un objet qui est une surcouche de $_POST
       dump($request->request->all());
        echo $request->request->get('nom');
        endif;


        return $this->render('base/requete.html.twig');
    }

    /**
     * @Route("/session")
     *
     * On injecte le SessionInterface de symfony pour accéder à la session
     */
    public function session(SessionInterface $session)
    {

        // Pour ajouter des données en session
        $session->set('prenom', 'cesaire');
        $session->set('nom', 'desaulle');



        // on peut accéder aux données de la session de symfony dans $_SESSION['_sf2_attributes']
        dump($_SESSION['_sf2_attributes']);

        // nous renvoie les données de la session
        dump($session->all());

        // pour accéder à un element de la session
        dump($session->get('prenom'));
    // suppression d'une entrée de la session
        $session->remove('prenom');
        dump($session->get('prenom'));

        // suppression de la session entière
        $session->clear();

        dump($session->all());


       return $this->render('base/index.html.twig');
    }


}
