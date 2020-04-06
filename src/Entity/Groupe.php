<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 * @UniqueEntity("idAnimalPorsolt")
 */
class Groupe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $intitule;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreAnimaux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idAnimalPorsolt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomUsuel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $puce;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="groupes")
     */
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function getSlug(): string
    {
        return (new Slugify())-> slugify($this->intitule);
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getNbreAnimaux(): ?int
    {
        return $this->nbreAnimaux;
    }

    public function setNbreAnimaux(int $nbreAnimaux): self
    {
        $this->nbreAnimaux = $nbreAnimaux;

        return $this;
    }

    public function getIdAnimalPorsolt(): ?string
    {
        return $this->idAnimalPorsolt;
    }

    public function setIdAnimalPorsolt(string $idAnimalPorsolt): self
    {
        $this->idAnimalPorsolt = $idAnimalPorsolt;

        return $this;
    }

    public function getNomUsuel(): ?string
    {
        return $this->nomUsuel;
    }

    public function setNomUsuel(string $nomUsuel): self
    {
        $this->nomUsuel = $nomUsuel;

        return $this;
    }

    public function getPuce(): ?string
    {
        return $this->puce;
    }

    public function setPuce(string $puce): self
    {
        $this->puce = $puce;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }


}
