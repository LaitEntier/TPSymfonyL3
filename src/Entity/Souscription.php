<?php

namespace App\Entity;

use App\Repository\SouscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SouscriptionRepository::class)
 */
class Souscription
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
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="relation")
     */
    private $UserSouscription;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="relation")
     */
    private $SouscriptionOffer;

    public function __construct(User $user, Offer $offer) {
        $this->etat = 'En attente';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getUserSouscription(): ?User
    {
        return $this->UserSouscription;
    }

    public function setUserSouscription(?User $UserSouscription): self
    {
        $this->UserSouscription = $UserSouscription;

        return $this;
    }

    public function getSouscriptionOffer(): ?Offer
    {
        return $this->SouscriptionOffer;
    }

    public function setSouscriptionOffer(?Offer $SouscriptionOffer): self
    {
        $this->SouscriptionOffer = $SouscriptionOffer;

        return $this;
    }
}
