<?php

namespace App\Entity;

use App\Repository\AdministratorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdministratorRepository::class)]
class Administrator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $UUID_administrator = null;

    #[ORM\Column(length: 50)]
    private ?string $UUID_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUUIDAdministrator(): ?string
    {
        return $this->UUID_administrator;
    }

    public function setUUIDAdministrator(string $UUID_administrator): static
    {
        $this->UUID_administrator = $UUID_administrator;

        return $this;
    }

    public function getUUIDUser(): ?string
    {
        return $this->UUID_user;
    }

    public function setUUIDUser(string $UUID_user): static
    {
        $this->UUID_user = $UUID_user;

        return $this;
    }
}
