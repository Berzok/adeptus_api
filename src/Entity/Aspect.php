<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aspect
 *
 * @ORM\Table(name="aspect")
 * @ORM\Entity
 */
class Aspect {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=55, nullable=true, options={"default"="NULL"})
     */
    private $nom = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=252, nullable=true, options={"default"="NULL"})
     */
    private $description = 'NULL';

    /**
     * @var mixed
     *
     * @ORM\Column(type="string", columnDefinition="ENUM('Defining', 'Character', 'Trauma')")
     */
    private mixed $type;


    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Aspect
     */
    public function setId(int $id): Aspect {
        $this->id = $id;
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
     * @return Aspect
     */
    public function setNom(?string $nom): Aspect {
        $this->nom = $nom;
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
     * @return Aspect
     */
    public function setDescription(?string $description): Aspect {
        $this->description = $description;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getType(): String|null {
        return $this->type;
    }

    /**
     * @param String $type
     * @return Aspect
     */
    public function setType(String $type): Aspect {
        $this->type = $type;
        return $this;
    }

}
