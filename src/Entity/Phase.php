<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhaseRepository")
 */
class Phase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="phase")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etude", mappedBy="phase")
     */
    private $etudes;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->etudes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setPhase($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getPhase() === $this) {
                $produit->setPhase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Etude[]
     */
    public function getEtudes(): Collection
    {
        return $this->etudes;
    }

    public function addEtude(Etude $etude): self
    {
        if (!$this->etudes->contains($etude)) {
            $this->etudes[] = $etude;
            $etude->setPhase($this);
        }

        return $this;
    }

    public function removeEtude(Etude $etude): self
    {
        if ($this->etudes->contains($etude)) {
            $this->etudes->removeElement($etude);
            // set the owning side to null (unless already changed)
            if ($etude->getPhase() === $this) {
                $etude->setPhase(null);
            }
        }

        return $this;
    }
}
