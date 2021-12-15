<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonnageAtouts
 *
 * @ORM\Table(name="personnage_atouts", indexes={@ORM\Index(name="id_personnage", columns={"id_personnage"}), @ORM\Index(name="id_atout", columns={"id_atout"})})
 * @ORM\Entity
 */
class PersonnageAtouts {

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
     * @ORM\ManyToOne(targetEntity="Personnage", inversedBy="atouts")
     */
    private $personnage;

    /**
     * @var Atout
     *
     * @ORM\ManyToOne(targetEntity="Atout")
     */
    private $atout;


    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): self{
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

    public function getAtout(): ?Atout {
        return $this->atout;
    }

    public function setAtout(?Atout $atout): self {
        $this->atout = $atout;

        return $this;
    }


}
