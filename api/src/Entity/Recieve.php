<?php

namespace App\Entity;

use App\Repository\RecieveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecieveRepository::class)]
class Recieve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Users $UUID_user = null;

    #[ORM\ManyToOne(inversedBy: 'recieves')]
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
