<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * CompetenceSpecialisation
 *
 * @ORM\Table(name="competence_specialisation", indexes={@ORM\Index(name="id_competence", columns={"id_competence"})})
 * @ORM\Entity
 */
class CompetenceSpecialisation {

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
     * @var bool|null
     *
     * @ORM\Column(name="restreinte", type="boolean", nullable=true)
     */
    private $restreinte = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $description = NULL;

    /**
     * @var Competence
     *
     * @ORM\ManyToOne(targetEntity="Competence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_competence", referencedColumnName="id")
     * })
     * @Serializer\Exclude()
     */
    private $id_competence;


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

    public function getRestreinte(): ?bool {
        return $this->restreinte;
    }

    public function setRestreinte(?bool $restreinte): self {
        $this->restreinte = $restreinte;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;

        return $this;
    }

    public function getIdCompetence(): ?Competence {
        return $this->id_competence;
    }

    public function setIdCompetence(?Competence $id_competence): self {
        $this->id_competence = $id_competence;

        return $this;
    }


}
