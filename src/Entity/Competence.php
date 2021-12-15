<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Competence
 *
 * @ORM\Table(name="competence")
 * @ORM\Entity
 */
class Competence {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=55, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $description = NULL;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="CompetenceSpecialisation", mappedBy="id_competence")
     */
    private Collection $specialisations;


    public function __construct() {
        $this->specialisations = new ArrayCollection();
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;

        return $this;
    }

    /**
     * @return CompetenceSpecialisation|ArrayCollection|Collection
     */
    public function getSpecialisations(): CompetenceSpecialisation|ArrayCollection|Collection {
        return $this->specialisations;
    }

    public function addSpecialisation(CompetenceSpecialisation $specialisation): self {
        if (!$this->specialisations->contains($specialisation)) {
            $this->specialisations[] = $specialisation;
            $specialisation->setIdCompetence($this);
        }
        return $this;
    }

    public function removeSpecialisation(CompetenceSpecialisation $specialisations): self {
        if ($this->specialisations->removeElement($specialisations)) {
            // set the owning side to null (unless already changed)
            if ($specialisations->getIdCompetence() === $this) {
                $specialisations->setIdCompetence(null);
            }
        }
        return $this;
    }

}
