<?php

namespace App\Entity;

use App\Repository\SendRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SendRepository::class)]
class Send
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sends')]
    private ?Users $UUID_user = null;

    #[ORM\ManyToOne(inversedBy: 'sends')]
    private ?Message $UUID_message = null;

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
