<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personnage
 *
 * @ORM\Table(name="personnage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonnageRepository")
 */
class Personnage {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var \stdClass
     *
     * @ORM\OneToOne(targetEntity= "Stats")
     * @ORM\JoinColumn(name="fk_stats", referencedColumnName="id")
     */
    private $stats;

    /**
     * @var \stdClass
     *
     * @ORM\OneToOne(targetEntity= "Race")
     * @ORM\JoinColumn(name="fk_race", referencedColumnName="id")
     */
    private $race;

    /**
     * @var \stdClass
     *
     * @ORM\OneToOne(targetEntity= "Classe")
     * @ORM\JoinColumn(name="fk_classes", referencedColumnName="id")
     */
    private $classe;

    /**
     * @var type 
     * 
     * @ORM\Column(name="pa", type="integer")
     */
    private $pa;
    private $positionH;
    private $positionV;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Personnage
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set stats
     *
     * @param \stdClass $stats
     *
     * @return Personnage
     */
    public function setStats($stats) {
        $this->stats = $stats;

        return $this;
    }

    /**
     * Get stats
     *
     * @return \stdClass
     */
    public function getStats() {
        return $this->stats;
    }

    /**
     * Set race
     *
     * @param \stdClass $race
     *
     * @return Personnage
     */
    public function setRace($race) {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return \stdClass
     */
    public function getRace() {
        return $this->race;
    }

    /**
     * Set classe
     *
     * @param \stdClass $classe
     *
     * @return Personnage
     */
    public function setClasse($classe) {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \stdClass
     */
    public function getClasse() {
        return $this->classe;
    }

    /**
     * Get pa
     *
     * @return int
     */
    function getPa(): type {
        return $this->pa;
    }

    /**
     * Set pa
     *
     * @param integer $pa
     *
     * @return Personnage
     */
    function setPa(type $pa) {
        $this->pa = $pa;
        return $this;
    }

    /**
     * Attaque le personnage ciblé en parametre
     * 
     * @param \AppBundle\Entity\Personnage $cible
     */
    public function attaquer(Personnage $cible) {
        
    }

    /**
     * Changer sa position initiale par les nouvelles coordonnée
     * 
     * @param int $ligne
     * @param int $colonne
     */
    public function seDeplacer(int $ligne, int $colonne) {
        $this->positionH = $ligne;
        $this->positionV = $colonne;
    }

    /**
     * Methode pour mourir
     */
    public function paul() {
        
    }

}
