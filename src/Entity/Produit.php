<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $idProduitPorsolt;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $groupe;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nbreAnimaux;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $voieAdmin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePremierPrelevement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etude", inversedBy="produits")
     */
    private $etude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Phase", inversedBy="produits")
     */
    private $phase;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Groupe", mappedBy="produit", orphanRemoval=true,)
     */
    private $groupes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TempsPrelevement", mappedBy="produit")
     */
    private $tempsPrelevements;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->datePremierPrelevement = new \DateTime();
        $this->tempsPrelevements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduitPorsolt(): ?string
    {
        return $this->idProduitPorsolt;
    }

    public function setIdProduitPorsolt(string $idProduitPorsolt): self
    {
        $this->idProduitPorsolt = $idProduitPorsolt;

        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function getSlug(): string
    {
        return (new Slugify())-> slugify($this->groupe);
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

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

    public function getVoieAdmin(): ?string
    {
        return $this->voieAdmin;
    }

    public function setVoieAdmin(string $voieAdmin): self
    {
        $this->voieAdmin = $voieAdmin;

        return $this;
    }

    public function getDatePremierPrelevement(): ?\DateTimeInterface
    {
        return $this->datePremierPrelevement;
    }

    public function setDatePremierPrelevement(\DateTimeInterface $datePremierPrelevement): self
    {
        $this->datePremierPrelevement = $datePremierPrelevement;

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

    public function getEtude(): ?Etude
    {
        return $this->etude;
    }

    public function setEtude(?Etude $etude): self
    {
        $this->etude = $etude;

        return $this;
    }

    public function getPhase(): ?Phase
    {
        return $this->phase;
    }

    public function setPhase(?Phase $phase): self
    {
        $this->phase = $phase;

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
            $groupe->setProduit($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            // set the owning side to null (unless already changed)
            if ($groupe->getProduit() === $this) {
                $groupe->setProduit(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->idProduitPorsolt;

    }

    /**
     * @return Collection|TempsPrelevement[]
     */
    public function getTempsPrelevements(): Collection
    {
        return $this->tempsPrelevements;
    }

    public function addTempsPrelevement(TempsPrelevement $tempsPrelevement): self
    {
        if (!$this->tempsPrelevements->contains($tempsPrelevement)) {
            $this->tempsPrelevements[] = $tempsPrelevement;
            $tempsPrelevement->addProduit($this);
        }

        return $this;
    }

    public function removeTempsPrelevement(TempsPrelevement $tempsPrelevement): self
    {
        if ($this->tempsPrelevements->contains($tempsPrelevement)) {
            $this->tempsPrelevements->removeElement($tempsPrelevement);
            $tempsPrelevement->removeProduit($this);
        }

        return $this;
    }

}