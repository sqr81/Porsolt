<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudeRepository")
 * @UniqueEntity("numero")
 */
class Etude
{
    const TEST = [
        0 => 'stocké',
        1 => 'en cours',
        2 => 'envoyé',
        3 => 'détruit',
    ];

    const ESPECE = [
        0 => 'souris',
        1 => 'rat',
        2 => 'chien',
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sponsor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $testType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $de;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $representantSponsor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commercial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $especeAnimale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="etude")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="etude")
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Phase", inversedBy="etudes")
     */
    private $phase;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSponsor(): ?string
    {
        return $this->sponsor;
    }

    public function setSponsor(string $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    public function getTestType(): ?string
    {
        return $this->testType;
    }

    public function setTestType(string $testType): self
    {
        $this->testType = $testType;

        return $this;
    }

    public function getDe(): ?string
    {
        return $this->de;
    }

    public function setDe(string $de): self
    {
        $this->de = $de;

        return $this;
    }

    public function getRepresentantSponsor(): ?string
    {
        return $this->representantSponsor;
    }

    public function setRepresentantSponsor(string $representantSponsor): self
    {
        $this->representantSponsor = $representantSponsor;

        return $this;
    }

    public function getTre(): ?string
    {
        return $this->tre;
    }

    public function setTre(string $tre): self
    {
        $this->tre = $tre;

        return $this;
    }

    public function getCommercial(): ?string
    {
        return $this->commercial;
    }

    public function setCommercial(string $commercial): self
    {
        $this->commercial = $commercial;

        return $this;
    }

    public function getEspeceAnimale(): ?string
    {
        return $this->especeAnimale;
    }

    public function setEspeceAnimale(string $especeAnimale): self
    {
        $this->especeAnimale = $especeAnimale;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEtude($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getEtude() === $this) {
                $user->setEtude(null);
            }
        }

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
            $produit->setEtude($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getEtude() === $this) {
                $produit->setEtude(null);
            }
        }

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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())-> slugify($this->numero);
    }

    public function getFormattedNumero(): string
    {
        return number_format($this->numero,0, '', ' ' );
    }
}
