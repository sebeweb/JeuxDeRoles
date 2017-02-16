<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use AppBundle\Entity\Personnage;
use AppBundle\Entity\Stats;
use AppBundle\Form\PersonnageType;
use AppBundle\Form\StatsType;
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
        //boucle sur valeurs de 1 à 4
        for ($i = 1; $i <= 4; $i++) {
            //stockage de la valeur dans la variabe email
            $email = $r->get('j' . strval($i));
            if ($email != null) {
                $joueurs = $this->getDoctrine()->getRepository(Joueur::class)->findByEmail($email);
                if ($joueurs != null) {
                    $joueur = $joueurs[0];
//                    return new Response($joueurs[0]->getEmail());
                } else {
                    //si nouveau joueur
                    $joueur = new Joueur();
                    $joueur->setEmail($email);
                    $entityManager->persist($joueur);
                }
                //mise en session du joueur
                $r->getSession()->set('j' . strval($i), $joueur); // 
            }
        }
        $entityManager->flush();
        $r->getSession()->set('actuel', 1);
        return $this->redirectToRoute('createPerso');
    }

    /**
     * @Route("/perso/create",name="savePersonnage")
     * @param Request $r
     */
    public function savePersonnage(Request $r) {
        $em = $this->getDoctrine()->getManager();
        $personnage = new Personnage();
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($r);

        $em->persist($personnage->majStats());
        $em->persist($personnage);
        $this->mergeJoueur($personnage, $r, $em);
        $em->flush();
        return $this->redirectToRoute("stats");
    }

    /**
     * @Route("/up/stats", name="statsUp")
     */
    public function upStats(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $joueur = $request->getSession()->get("j" . strval($request->getSession()->get('actuel')));
        $stats = $em->getRepository(Stats::class)->find($joueur->getPersonnage()->getStats()->getId());
        $form = $this->createForm(StatsType::class, $stats);
        $form->handleRequest($request);
        $em->merge($stats);
        $em->flush();
        return $this->redirect($this->generateUrl('switch'));
    }

    /**
     * Cette methode nous permet de lier un joueur a un personnage
     * 
     * @param type $perso personnage a merger
     * @param type $r Request
     * @param type $em entity manager
     * @return type 
     */
    public function mergeJoueur($perso, $r, $em) {
        $joueur = $r->getSession()->get("j" . strval($r->getSession()->get('actuel')));
        $joueur->setPersonnage($perso);
        $em->merge($joueur);
        return $em;
    }

    /**
     * Doit etre appelée par la validation de la création du personnage precendent !
     * @param Request $r
     * @return type
     * @Route("/perso/switch",name="switch")
     */
    public function switchPlayer(Request $r) {
        $next = $r->getSession()->get('actuel') + 1;
        if ($r->getSession()->has('j' . strval($next))) {
            $r->getSession()->set('actuel', $next);
            return $this->redirectToRoute('createPerso');
        } else {
            return $this->redirectToRoute('game');
        }
    }

}
