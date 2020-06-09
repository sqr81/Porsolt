<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TempsPrelevementRepository")
 */
class TempsPrelevement
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
    private $tempsPrelevement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prelevement", mappedBy="tempsPrelevement")
     */
    private $prelevements;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", mappedBy="tempsPrelevement")
     */
    private $groupes;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $dataCheckBox = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="tempsPrelevements")
     */
    private $produit;

    public function __construct()
    {
        $this->prelevements = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->dataCheckBox = new ArrayCollection();
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempsPrelevement(): ?string
    {
        return $this->tempsPrelevement;
    }

    public function setTempsPrelevement(?string $tempsPrelevement): self
    {
        $this->tempsPrelevement = $tempsPrelevement;

        return $this;
    }

    /**
     * @return Collection|Prelevement[]
     */
    public function getPrelevements(): Collection
    {
        return $this->prelevements;
    }

    public function addPrelevement(Prelevement $prelevement): self
    {
        if (!$this->prelevements->contains($prelevement)) {
            $this->prelevements[] = $prelevement;
            $prelevement->setTempsPrelevement($this);
        }

        return $this;
    }

    public function removePrelevement(Prelevement $prelevement): self
    {
        if ($this->prelevements->contains($prelevement)) {
            $this->prelevements->removeElement($prelevement);
            // set the owning side to null (unless already changed)
            if ($prelevement->getTempsPrelevement() === $this) {
                $prelevement->setTempsPrelevement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addTempsPrelevement($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeTempsPrelevement($this);
        }

        return $this;
    }

    public function getDataCheckBox(): ArrayCollection
    {
        return $this->dataCheckBox;
    }

    public function setDataCheckBox(?array $dataCheckBox): self
    {
        $this->dataCheckBox = $dataCheckBox;

        return $this;
    }

    public function __toString()
    {
        return $this->tempsPrelevement;

    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function setProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produit->contains($produit)) {
            $this->produit->removeElement($produit);
        }

        return $this;
    }
}
