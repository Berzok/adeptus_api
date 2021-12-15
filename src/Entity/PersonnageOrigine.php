<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonnageRepository;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use JMS\Serializer\Annotation as Serializer;

/**
 * Personnage
 *
 * @ORM\Table(name="personnage_origine")
 * @ORM\Entity
 */
class PersonnageOrigine {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Exclude()
     */
    private $id;

    /**
     * @var Personnage
     *
     * @OneToOne(targetEntity="Personnage", mappedBy="origine")
     * @JoinColumn(name="id_personnage", referencedColumnName="id")
     * @Serializer\Exclude()
     */
    private Personnage $personnage;

    /**
     * @var Origine|null
     * @ORM\OneToOne(targetEntity="Origine")
     * @JoinColumn(name="id_origine", referencedColumnName="id")
     */
    private Origine $origine;


    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PersonnageOrigine
     */
    public function setId(int $id): PersonnageOrigine {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Personnage
     */
    public function getPersonnage(): Personnage {
        return $this->personnage;
    }

    /**
     * @param Personnage $personnage
     * @return PersonnageOrigine
     */
    public function setPersonnage(Personnage $personnage): PersonnageOrigine {
        $this->personnage = $personnage;
        return $this;
    }

    /**
     * @return Origine|null
     */
    public function getOrigine(): ?Origine {
        return $this->origine;
    }

    /**
     * @param Origine|null $origine
     * @return PersonnageOrigine
     */
    public function setOrigine(?Origine $origine): PersonnageOrigine {
        $this->origine = $origine;
        return $this;
    }

}
