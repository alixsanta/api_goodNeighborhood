<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\RecieveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecieveRepository::class)]
class Recieve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'recieve')]
    #[ORM\JoinColumn(name: 'user_uuid', referencedColumnName: 'UUID_user')]
    private ?User $UUID_user = null;

    #[ORM\ManyToOne(inversedBy: 'recieves')]
    private ?Message $UUID_message = null;

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

    public function getUUIDMessage(): ?Message
    {
        return $this->UUID_message;
    }

    public function setUUIDMessage(?Message $UUID_message): static
    {
        $this->UUID_message = $UUID_message;

        return $this;
    }
}
