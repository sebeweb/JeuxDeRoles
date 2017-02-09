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
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PlayerController
 *
 * @author sebastien-javary
 */
class PlayerController extends Controller {
    /**
     * Methode qui va ajouter les joueur en base de donnée
     * A la fin du traitement on est rediriger sur le controller
     * afin de retourner la vue de ceation de personnages
     * @Route("/players/add", name="addPlayers")
     * 
     */
    public function addPlayers(Request $r) {
        return $this->redirectToRoute('createPerso');
////        ma permi de verifierles valeur du formulaire
//        return new Response($r->get('j1'));
    }
}
