<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * PersonnageCaracteristiques
 *
 * @ORM\Table(name="personnage_caracteristiques", indexes={@ORM\Index(name="id_personnage", columns={"id_personnage"}), @ORM\Index(name="id_caracteristique", columns={"id_caracteristique"})})
 * @ORM\Entity
 */
class PersonnageCaracteristiques {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="score", type="integer", nullable=true, options={"default"="0"})
     */
    private ?int $score = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="score_max", type="integer", nullable=true, options={"default"="0"})
     */
    private ?int $score_max = 0;

    /**
     * @var Personnage
     * @Serializer\Exclude()
     *
     * @ORM\OneToOne(targetEntity="Personnage")
     * @ORM\JoinColumn(name="id_personnage", referencedColumnName="id")
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


    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getScore(): ?int {
        return $this->score;
    }

    public function setScore(?int $score): self {
        $this->score = $score;

        return $this;
    }

    public function getScoreMax(): ?int {
        return $this->score_max;
    }

    public function setScoreMax(?int $score_max): self {
        $this->score_max = $score_max;

        return $this;
    }

    public function getPersonnage(): ?Personnage {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self {
        $this->personnage = $personnage;

        return $this;
    }

    public function getCaracteristique(): ?Caracteristique {
        return $this->caracteristique;
    }

    public function setCaracteristique(?Caracteristique $caracteristique): self {
        $this->caracteristique = $caracteristique;

        return $this;
    }


}
