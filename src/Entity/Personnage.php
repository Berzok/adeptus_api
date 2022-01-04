<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonnageRepository;
use JMS\Serializer\Annotation as Serializer;

/**
 * Personnage
 *
 * @ORM\Table(name="personnage")
 * @ORM\Entity(repositoryClass=PersonnageRepository::class)
 */
class Personnage {

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
     * @ORM\Column(name="prenom", type="string", length=40, nullable=false)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=40, nullable=true, options={"default"="NULL"})
     */
    private ?string $nom = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="sexe", type="string", length=2, nullable=true, options={"default"="NULL"})
     */
    private $sexe = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $image = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $age = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="taille", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $taille = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="masse", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $masse = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nationalite", type="string", length=45, nullable=true, options={"default"="NULL"})
     */
    private $nationalite = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $description = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inventaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $inventaire = NULL;


    /**
     * @var Origine
     * @ORM\OneToOne(targetEntity="Origine")
     * @ORM\JoinColumn(name="id_origine", referencedColumnName="id")
     */
    private null|Origine $origine = null;


    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PersonnageCaracteristiques", mappedBy="personnage")
     */
    private ?Collection $caracteristiques = NULL;

    /**
     * @var Collection
     * @Serializer\MaxDepth(6)
     *
     * @ORM\OneToMany(targetEntity="PersonnageCompetences", mappedBy="personnage")
     */
    private ?Collection $competences = NULL;

    /**
     * @var ?Collection
     *
     * @ORM\ManyToMany(targetEntity="Handicap", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="personnage_handicaps",
     *      joinColumns={@ORM\JoinColumn(name="id_personnage", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_handicap", referencedColumnName="id", unique=true)}
     *      )
     */
    private ?Collection $handicaps = NULL;

    /**
     * @var ?Collection
     *
     * @ORM\ManyToMany(targetEntity="Atout", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="personnage_atouts",
     *      joinColumns={@ORM\JoinColumn(name="id_personnage", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_atout", referencedColumnName="id", unique=true)}
     *      )
     */
    private ?Collection $atouts = NULL;


    /**
     * @var Collection|null
     *
     * @ORM\ManyToMany(targetEntity="Aspect", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="personnage_aspect",
     *      joinColumns={@ORM\JoinColumn(name="id_personnage", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_aspect", referencedColumnName="id", unique=true)}
     *      )
     */
    private ?Collection $aspects = NULL;


    public function __construct() {
        $this->competences = new ArrayCollection();
        $this->caracteristiques = new ArrayCollection();
        $this->atouts = new ArrayCollection();
        $this->handicaps = new ArrayCollection();
        $this->aspects = new ArrayCollection();
    }


    /**
     * @return ?int
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Personnage
     */
    public function setId(int $id): Personnage {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): string {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Personnage
     */
    public function setPrenom(string $prenom): Personnage {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     * @return Personnage
     */
    public function setNom(?string $nom): Personnage {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSexe(): ?string {
        return $this->sexe;
    }

    /**
     * @param string|null $sexe
     * @return Personnage
     */
    public function setSexe(?string $sexe): Personnage {
        $this->sexe = $sexe;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Personnage
     */
    public function setImage(?string $image): Personnage {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int {
        return $this->age;
    }

    /**
     * @param int|null $age
     * @return Personnage
     */
    public function setAge(?int $age): Personnage {
        $this->age = $age;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTaille(): ?int {
        return $this->taille;
    }

    /**
     * @param int|null $taille
     * @return Personnage
     */
    public function setTaille(?int $taille): Personnage {
        $this->taille = $taille;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMasse(): ?int {
        return $this->masse;
    }

    /**
     * @param int|null $masse
     * @return Personnage
     */
    public function setMasse(?int $masse): Personnage {
        $this->masse = $masse;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationalite(): ?string {
        return $this->nationalite;
    }

    /**
     * @param string|null $nationalite
     * @return Personnage
     */
    public function setNationalite(?string $nationalite): Personnage {
        $this->nationalite = $nationalite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Personnage
     */
    public function setDescription(?string $description): Personnage {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInventaire(): ?string {
        return $this->inventaire;
    }

    /**
     * @param string|null $inventaire
     * @return Personnage
     */
    public function setInventaire(?string $inventaire): Personnage {
        $this->inventaire = $inventaire;
        return $this;
    }

    /**
     * @return Origine|null
     */
    public function getOrigine(): null|Origine {
        return $this->origine;
    }

    /**
     * @param Origine $origine
     * @return Personnage
     */
    public function setOrigine(Origine $origine): Personnage {
        $this->origine = $origine;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getCaracteristiques(): Collection {
        return $this->caracteristiques;
    }

    /**
     * @param Collection $caracteristiques
     * @return Personnage
     */
    public function setCaracteristiques(Collection $caracteristiques): Personnage {
        $this->caracteristiques = $caracteristiques;
        return $this;
    }

    public function addCaracteristique(PersonnageCaracteristiques $caracteristique): self {
        if ($this->caracteristiques === null) {
            $this->caracteristiques = new ArrayCollection();
        }
        if (!$this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques[] = $caracteristique;
            $caracteristique->setPersonnage($this);
        }

        return $this;
    }

    public function removeCaracteristique(PersonnageCaracteristiques $caracteristique): self {
        if ($this->caracteristiques->removeElement($caracteristique)) {
            // set the owning side to null (unless already changed)
            if ($caracteristique->getPersonnage() === $this) {
                $caracteristique->setPersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCompetences(): Collection {
        return $this->competences;
    }

    public function addCompetence(PersonnageCompetences $competence): self {
        if ($this->competences === null) {
            $this->competences = new ArrayCollection();
        }
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            //$competence->setPersonnage($this);
        }
        return $this;
    }

    public function removeCompetence(PersonnageCompetences $competence): self {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getIdPersonnage() === $this) {
                $competence->setIdPersonnage(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getHandicaps(): Collection {
        return $this->handicaps;
    }

    public function addHandicap(Handicap|PersonnageHandicaps $handicap): self {
        if ($this->handicaps === null) {
            $this->competences = new ArrayCollection();
        }
        if (!$this->handicaps->contains($handicap)) {
            $this->handicaps[] = $handicap;
//            $handicap->setPersonnage($this);
        }
        return $this;
    }

    public function removeHandicap(Handicap|PersonnageHandicaps $handicap): self {
        if($this->handicaps->removeElement($handicap)) {
            // set the owning side to null (unless already changed)
            /*
            if ($handicap->getPersonnage() === $this) {
                $handicap->setPersonnage(null);
            }
            */
        }
        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getAtouts(): ArrayCollection|Collection|null {
        return $this->atouts;
    }

    public function addAtout(Atout $atout): self {
        if ($this->atouts === null) {
            $this->atouts = new ArrayCollection();
        }
        if (!$this->atouts->contains($atout)) {
            $this->atouts[] = $atout;
//            $handicap->setPersonnage($this);
        }
        return $this;
    }

    public function removeAtout(Atout $atout): self {
        if($this->atouts->removeElement($atout)) {
            // set the owning side to null (unless already changed)
            /*
            if ($handicap->getPersonnage() === $this) {
                $handicap->setPersonnage(null);
            }
            */
        }
        return $this;
    }


    /**
     * @return Collection|null
     */
    public function getAspects(): ArrayCollection|Collection|null {
        return $this->aspects;
    }

    public function addAspect(Aspect $aspect): self {
        if ($this->aspects === null) {
            $this->aspects = new ArrayCollection();
        }
        if (!$this->aspects->contains($aspect)) {
            $this->aspects[] = $aspect;
        }
        return $this;
    }

    public function removeAspect(Aspect $aspect): self {
        if($this->aspects->removeElement($aspect)) {
            // set the owning side to null (unless already changed)
            /*
            if ($handicap->getPersonnage() === $this) {
                $handicap->setPersonnage(null);
            }
            */
        }
        return $this;
    }




    public function listProperties(): array {

        /*
        $reflection = new ReflectionClass($this);
        $vars = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);
        return $vars;
        */

        $properties = array_keys(get_class_vars(get_class($this))); // $this
        array_shift($properties);
        return $properties;
    }

}
