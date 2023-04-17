<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailRepository::class)]
class Detail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'details')]
    #[ORM\JoinColumn(nullable: false)]
    private ?commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'details')]
    #[ORM\JoinColumn(nullable: false)]
    private ?plat $plat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCommande(): ?commande
    {
        return $this->commande;
    }

    public function setCommande(?commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPlat(): ?plat
    {
        return $this->plat;
    }

    public function setPlat(?plat $plat): self
    {
        $this->plat = $plat;

        return $this;
    }
}
