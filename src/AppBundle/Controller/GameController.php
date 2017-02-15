<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of GameController
 *
 * @author sebastien-javary
 */
class GameController extends Controller {

    //put your code here
    /**
     * @Route("/position/", name="position")
     */
    public function getStartPosition() {
//        $joueur = $r->getSession()->get("j" . strval($r->getSession()->get('actuel')));
    
        echo $max;
    }

    public function switchPosition(Request $r) {
        $next = $r->getSession()->get('actuel') + 1;
        if ($r->getSession()->has('j' . strval($next))) {
            $r->getSession()->set('actuel', $next);
            return $this->redirectToRoute('position');
        } else {
            return $this->redirectToRoute('game');
        }
    }

    /**
     * Cette fonction ne s'exécute que si le mouvement est valide.
     * Cette fonction utilise les coordonnées retournées par le formulaire
     * et les assigne au personnage du joueur courant.
     * Le formulaire sera dynamiquement rempli à l'aide d'un script js qui
     * récupèrera les valeurs de la ligne et de la colonne selectionées sur le
     * plateau de jeu via un clic.
     * Le premier champ du formulaire contiendra la valeur de la ligne, le
     * second champ du formulaire contiendra la valeur de la colonne.
     * Le formulaire doit rediriger sur une url structurée telle que la route
     * ci-dessous.
     *
     * @Route("/game/move", name="move")
     */
    public function setDeplacement(Request $r) {
        $ligne = $r->get("ligne");
        echo $ligne;
        $colonne = $r->get("colonne");
        $em = $this->getDoctrine()->getManager();
        // On récupère le joueur actuel en session
        $joueur = $r->getSession()->get("j" . strval($r->getSession()->get('actuel')));
        // On apelle la méthode seDeplacer du personnage du joueur actuel
        $joueur->getPersonnage()->seDeplacer($ligne, $colonne);
        // On enlève un PA au personnage du joueur
        $joueur->getPersonnage()->setPa($joueur->getPersonnage()->getPa() - 1);
        // On merge les nouvelles valeurs au personnage
        echo $ligne;
        $em->merge($joueur->getPersonnage());
        $em->flush();
        return $this->redirectToRoute("game");
    }

}
