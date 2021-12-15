<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * PersonnageCompetencesSpecialisations
 *
 * @ORM\Table(name="personnage_competences_specialisations", indexes={@ORM\Index(name="id_personnage_competences", columns={"id_personnage_competences"}), @ORM\Index(name="id_competence_specialisation", columns={"id_competence_specialisation"})})
 * @ORM\Entity
 */
class PersonnageCompetencesSpecialisations {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="acquis", type="boolean", nullable=true)
     */
    private int|bool|null $acquis = 0;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="maitrise", type="boolean", nullable=true)
     */
    private int|bool|null $maitrise = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="bonus", type="integer", nullable=true)
     */
    private ?int $bonus = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     *
     * @Serializer\Exclude()
     */
    private ?int $score = 0;

    /**
     * @var PersonnageCompetences
     *
     * @ORM\ManyToOne(targetEntity="PersonnageCompetences")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_personnage_competences", referencedColumnName="id")
     * })
     *
     * @Serializer\Exclude()
     */
    private $personnage_competence;

    /**
     * @var CompetenceSpecialisation
     *
     * @ORM\OneToOne(targetEntity="CompetenceSpecialisation")
     * @ORM\JoinColumn(name="id_competence_specialisation", referencedColumnName="id")
     */
    private ?CompetenceSpecialisation $specialisation;


    public function __construct() {
        $this->setScore(0);
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PersonnageCompetencesSpecialisations
     */
    public function setId(int $id): PersonnageCompetencesSpecialisations {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAcquis(): bool|int|null {
        return $this->acquis;
    }

    /**
     * @param bool|null $acquis
     * @return PersonnageCompetencesSpecialisations
     */
    public function setAcquis(bool|int|null $acquis): PersonnageCompetencesSpecialisations {
        $this->acquis = $acquis;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMaitrise(): bool|int|null {
        return $this->maitrise;
    }

    /**
     * @param bool|null $maitrise
     * @return PersonnageCompetencesSpecialisations
     */
    public function setMaitrise(bool|int|null $maitrise): PersonnageCompetencesSpecialisations {
        $this->maitrise = $maitrise;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBonus(): ?int {
        return $this->bonus;
    }

    /**
     * @param int|null $bonus
     * @return PersonnageCompetencesSpecialisations
     */
    public function setBonus(?int $bonus): PersonnageCompetencesSpecialisations {
        $this->bonus = $bonus;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScore(): ?int {
        return $this->score;
    }

    /**
     * @param int|null $score
     * @return PersonnageCompetencesSpecialisations
     */
    public function setScore(?int $score): PersonnageCompetencesSpecialisations {
        $this->score = $score;
        return $this;
    }

    /**
     * @return PersonnageCompetences
     */
    public function getPersonnageCompetence(): PersonnageCompetences {
        return $this->personnage_competence;
    }

    /**
     * @param PersonnageCompetences $personnage_competence
     * @return PersonnageCompetencesSpecialisations
     */
    public function setPersonnageCompetence(PersonnageCompetences $personnage_competence): PersonnageCompetencesSpecialisations {
        $this->personnage_competence = $personnage_competence;
        return $this;
    }

    /**
     * @return CompetenceSpecialisation
     */
    public function getSpecialisation(): CompetenceSpecialisation {
        return $this->specialisation;
    }

    /**
     * @param CompetenceSpecialisation $specialisation
     * @return PersonnageCompetencesSpecialisations
     */
    public function setSpecialisation(CompetenceSpecialisation $specialisation): PersonnageCompetencesSpecialisations {
        $this->specialisation = $specialisation;
        return $this;
    }


}
