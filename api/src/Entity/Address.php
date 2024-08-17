<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_address = null;

    #[ORM\Column(length: 50)]
    private ?string $number_street = null;

    #[ORM\Column(length: 50)]
    private ?string $name_street = null;

    #[ORM\Column(length: 50)]
    private ?string $postal_code = null;

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAddress(): ?int
    {
        return $this->id_address;
    }

    public function setIdAddress(int $id_address): static
    {
        $this->id_address = $id_address;

        return $this;
    }

    public function getNumberStreet(): ?string
    {
        return $this->number_street;
    }

    public function setNumberStreet(string $number_street): static
    {
        $this->number_street = $number_street;

        return $this;
    }

    public function getNameStreet(): ?string
    {
        return $this->name_street;
    }

    public function setNameStreet(string $name_street): static
    {
        $this->name_street = $name_street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
}
