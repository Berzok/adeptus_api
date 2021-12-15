<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\NoReturn;
use JMS\Serializer\Annotation as Serializer;

/**
 * PersonnageCompetences
 *
 * @ORM\Table(name="personnage_competences", indexes={@ORM\Index(name="id_caracteristique", columns={"id_caracteristique"}), @ORM\Index(name="id_personnage", columns={"id_personnage"}), @ORM\Index(name="id_competence", columns={"id_competence"})})
 * @ORM\Entity
 */
class PersonnageCompetences {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer", nullable=true, options={"default"="0"})
     */
    private int $score = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="bonus", type="integer", nullable=true)
     */
    private int $bonus = 0;

    /**
     * @var Personnage
     *
     * @ORM\OneToOne(targetEntity="Personnage")
     * @ORM\JoinColumn(name="id_personnage", referencedColumnName="id")
     *
     * @Serializer\Exclude()
     */
    private Personnage $personnage;

    /**
     * @var Caracteristique
     *
     * @ORM\OneToOne(targetEntity="Caracteristique")
     * @ORM\JoinColumn(name="id_caracteristique", referencedColumnName="id")
     */
    private Caracteristique $caracteristique;

    /**
     * @var Competence
     *
     * @ORM\OneToOne(targetEntity="Competence")
     * @ORM\JoinColumn(name="id_competence", referencedColumnName="id")
     */
    private Competence $groupe;

    /**
     * @var CompetenceSpecialisation
     *
     * @ORM\OneToMany(targetEntity="PersonnageCompetencesSpecialisations", mappedBy="personnage_competence")
     *
     */
    private ?Collection $specialisations = NULL;


    public function __construct() {
        $this->specialisations = new ArrayCollection();
        $this->caracteristique = new Caracteristique();
        $this->groupe = new Competence();
        $this->setScore(0);
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }

    public function getScore(): ?int {
        return $this->score;
    }

    public function setScore(?int $score): self {
        $this->score = $score;
        return $this;
    }

    public function getBonus(): ?int {
        return $this->bonus;
    }

    public function setBonus(?int $bonus): self {
        $this->bonus = $bonus;

        return $this;
    }

    public function getCaracteristique(): ?Caracteristique {
        return $this->caracteristique;
    }

    public function setCaracteristique(?Caracteristique $caracteristique): self {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    /**
     * @return CompetenceSpecialisation|ArrayCollection|Collection
     */
    public function getSpecialisations(): CompetenceSpecialisation|ArrayCollection|Collection {
        return $this->specialisations;
    }


    public function addSpecialisation(PersonnageCompetencesSpecialisations $specialisation): self {
        if($this->specialisations === null){
            $this->specialisations = new ArrayCollection();
        }
        if (!$this->specialisations->contains($specialisation)) {
            $this->specialisations[] = $specialisation;
            $specialisation->setPersonnageCompetence($this);
        }
        return $this;
    }

    public function removeSpecialisation(PersonnageCompetencesSpecialisations $specialisations): self {
        if ($this->specialisations->removeElement($specialisations)) {
            // set the owning side to null (unless already changed)
            if ($specialisations->getPersonnageCompetence() === $this) {
                $specialisations->setPersonnageCompetence(null);
            }
        }
        return $this;
    }

    public function getGroupe(): ?Competence {
        return $this->groupe;
    }

    public function setGroupe(?Competence $groupe): self {
        $this->groupe = $groupe;

        return $this;
    }


}
