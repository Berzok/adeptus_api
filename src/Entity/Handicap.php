<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Handicap
 *
 * @ORM\Table(name="handicap")
 * @ORM\Entity
 */
class Handicap {

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
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="valeur", type="integer", nullable=false)
     */
    private $valeur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $description = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="effet", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $effet = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="special", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $special = 'NULL';



    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Handicap
     */
    public function setId(int $id): Handicap {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Handicap
     */
    public function setNom(string $nom): Handicap {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Handicap
     */
    public function setType(string $type): Handicap {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getValeur(): int {
        return $this->valeur;
    }

    /**
     * @param int $valeur
     * @return Handicap
     */
    public function setValeur(int $valeur): Handicap {
        $this->valeur = $valeur;
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
     * @return Handicap
     */
    public function setDescription(?string $description): Handicap {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEffet(): ?string {
        return $this->effet;
    }

    /**
     * @param string|null $effet
     * @return Handicap
     */
    public function setEffet(?string $effet): Handicap {
        $this->effet = $effet;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecial(): ?string {
        return $this->special;
    }

    /**
     * @param string|null $special
     * @return Handicap
     */
    public function setSpecial(?string $special): Handicap {
        $this->special = $special;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     * @return Handicap
     */
    public function setLocale($locale) {
        $this->locale = $locale;
        return $this;
    }

}
