<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\ResidentGroup;
use App\Repository\BelongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BelongRepository::class)]
class Belong
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    //private ?int $id = null;
    
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'belongs')]
    #[ORM\JoinColumn(name: 'user_uuid', referencedColumnName: 'UUID_user')]
    private $user;
    private ?User $UUID_user = null;

    #[ORM\ManyToOne(inversedBy: 'belongs')]
    private ?ResidentGroup $UUID_group = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getUser(): ?User
    {
        return $this->UUID_user;
    }

    public function setUser(?User $UUID_user): self
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
