<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonnageHandicaps
 *
 * @ORM\Table(name="personnage_handicaps", indexes={@ORM\Index(name="id_personnage", columns={"id_personnage"}), @ORM\Index(name="id_handicap", columns={"id_handicap"})})
 * @ORM\Entity
 */
class PersonnageHandicaps {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Personnage
     *
     * @ORM\ManyToOne(targetEntity="Personnage", inversedBy="handicaps")
     */
    private $personnage;

    /**
     * @var Handicap
     *
     * @ORM\ManyToOne(targetEntity="Handicap")
     */
    private $handicap;


    public function getId(): ?int {
        return $this->id;
    }
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getPersonnage(): ?Personnage {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self {
        $this->personnage = $personnage;
        return $this;
    }

    public function getHandicap(): ?Handicap {
        return $this->handicap;
    }

    public function setHandicap(?Handicap $handicap): self {
        $this->handicap = $handicap;
        return $this;
    }


}
