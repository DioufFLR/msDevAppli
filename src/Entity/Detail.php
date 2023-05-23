<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\DBAL\Types\Types;
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
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'details')]
    #[ORM\JoinColumn(referencedColumnName:"id", onDelete:"CASCADE")]
    private ?Plat $plat = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $totalRecapitulatif = null;

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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPlat(): ?Plat
    {
        return $this->plat;
    }

    public function setPlat(?Plat $plat): self
    {
        $this->plat = $plat;

        return $this;
    }

//    public function removeDetail(Plat $plat): self
//    {
//        if ($this->plats->removeElement($plat)) {
//            // set the owning side to null (unless already changed)
//            if ($plat->getDetail() === $this) {
//                $plat->setDetail(null);
//            }
//        }
//        return $this;
//    }

public function getPrix(): ?string
{
    return $this->prix;
}

public function setPrix(string $prix): self
{
    $this->prix = $prix;

    return $this;
}

public function getTotalRecapitulatif(): ?string
{
    return $this->totalRecapitulatif;
}

public function setTotalRecapitulatif(string $totalRecapitulatif): self
{
    $this->totalRecapitulatif = $totalRecapitulatif;

    return $this;
}
}
