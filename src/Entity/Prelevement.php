<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrelevementRepository")
 */
class Prelevement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type_prelevement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="prelevements")
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TempsPrelevement", inversedBy="prelevements")
     */
    private $tempsPrelevement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePrelevement(): ?string
    {
        return $this->type_prelevement;
    }

    public function setTypePrelevement(?string $type_prelevement): self
    {
        $this->type_prelevement = $type_prelevement;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getTempsPrelevement(): ?TempsPrelevement
    {
        return $this->tempsPrelevement;
    }

    public function setTempsPrelevement(?TempsPrelevement $tempsPrelevement): self
    {
        $this->tempsPrelevement = $tempsPrelevement;

        return $this;
    }

    public function __toString()
    {
        return $this->type_prelevement;

    }
}
