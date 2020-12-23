<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $textintro;

    /**
     * @ORM\Column(type="text")
     */
    private $textoffre;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Souscription::class, mappedBy="SouscriptionOffer")
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTextintro(): ?string
    {
        return $this->textintro;
    }

    public function setTextintro(string $textintro): self
    {
        $this->textintro = $textintro;

        return $this;
    }

    public function getTextoffre(): ?string
    {
        return $this->textoffre;
    }

    public function setTextoffre(string $textoffre): self
    {
        $this->textoffre = $textoffre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Souscription[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Souscription $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setSouscriptionOffer($this);
        }

        return $this;
    }

    public function removeRelation(Souscription $relation): self
    {
        if ($this->relation->contains($relation)) {
            $this->relation->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getSouscriptionOffer() === $this) {
                $relation->setSouscriptionOffer(null);
            }
        }

        return $this;
    }
}
