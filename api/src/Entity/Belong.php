<?php

namespace App\Entity;

use App\Repository\BelongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BelongRepository::class)]
class Belong
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'belongs')]
    private ?Users $UUID_user = null;

    #[ORM\ManyToOne(inversedBy: 'belongs')]
    private ?ResidentGroup $UUID_group = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUUIDUser(): ?Users
    {
        return $this->UUID_user;
    }

    public function setUUIDUser(?Users $UUID_user): static
    {
        $this->UUID_user = $UUID_user;

        return $this;
    }

    public function getUUIDGroup(): ?ResidentGroup
    {
        return $this->UUID_group;
    }

    public function setUUIDGroup(?ResidentGroup $UUID_group): static
    {
        $this->UUID_group = $UUID_group;

        return $this;
    }
}
