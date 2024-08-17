<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriceRepository::class)]
class Price
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $id_publication = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPrice(): ?int
    {
        return $this->id_price;
    }

    public function setIdPrice(int $id_price): static
    {
        $this->id_price = $id_price;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getIdPublication(): ?int
    {
        return $this->id_publication;
    }

    public function setIdPublication(int $id_publication): static
    {
        $this->id_publication = $id_publication;

        return $this;
    }
}
