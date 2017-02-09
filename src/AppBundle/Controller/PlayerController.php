<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PlayerController
 *
 * @author sebastien-javary
 */
class PlayerController extends Controller {

    /**
     * Methode qui va ajouter les joueur en base de donnée
     * A la fin du traitement on est rediriger sur le controller de vue
     * afin de retourner la vue de ceation de personnages
     * 
     * si le joueur existe en db, on le met en session 
     * sinon on l'enregistre, et on le met en session 
     * @Route("/players/add", name="addPlayers")
     * @Method({"POST"})
     * 
     */
    public function addPlayers(Request $r) {
        $entityManager = $this->getDoctrine()->getManager();
        for ($i = 1; $i <= 4; $i++) {
            //stokage de la valeur la variable emailS
            $email = $r->get('j' . strval($i));
            // creer un joueur en DB, et le mettre en session
            if ($email != null) {
                $joueur = $this->verifMail($email, $r, $i);
            }
            $entityManager->flush($joueur);
        }
        return $this->redirectToRoute('createPerso');
////        ma permi de verifierles valeur du formulaire
//        return new Response($r->get('j1'));
    }

    public function verifMail($email, $r, $i) {
        $entityManager = $this->getDoctrine()->getManager();

        $test = $entityManager->getRepository(Joueur::class)->findByEmail($email);
        if ($test) {
            $r->getSession()->set('j' . strval($i), $test);
            return $this->redirectToRoute("homepage");
        } else {
            $joueur = new Joueur();
            $joueur->setEmail($email);
            $entityManager->persist($joueur);
            $r->getSession()->set('j' . strval($i), $joueur);
            return $joueur;
        }
    }

}
