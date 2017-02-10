<?php

namespace AppBundle\Controller;

use AppBundle\Form\PersonnageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/personnage/creation", name="createPerso")
     */
    public function creationPersonnnage(Request $request) {
        //création du formulaire basé sur le Personnage
        $formPerso = $this->createForm(PersonnageType::class)->createView();
        //Recuperation de l'objet joueur en session
        $numeroDuJoueur = $request->getSession()->get('actuel');
        $numeroDuJoueurEnChaineDeCaractere = strval($numeroDuJoueur);
        $joueur = $request->getSession()->get("j" . $numeroDuJoueurEnChaineDeCaractere);
        // on retourne tout sur la vue twig
        return $this->render('default/creationPersonnage.html.twig', array(
                    'formPerso' => $formPerso,
                    "j" => $joueur,
                    "joueur" => $request->getSession()->get("j" . strval($request->getSession()->get('actuel')))
        ));
    }

    /**
     * @Route("/game", name="game")
     */
    public function getGameUI(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/game_ui.twig');
    }
}
