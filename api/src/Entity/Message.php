<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $UUID_message = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    /**
     * @var Collection<int, Recieve>
     */
    #[ORM\OneToMany(targetEntity: Recieve::class, mappedBy: 'UUID_message')]
    private Collection $recieves;

    /**
     * @var Collection<int, Send>
     */
    #[ORM\OneToMany(targetEntity: Send::class, mappedBy: 'UUID_message')]
    private Collection $sends;

    public function __construct()
    {
        $this->recieves = new ArrayCollection();
        $this->sends = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUUIDMessage(): ?int
    {
        return $this->UUID_message;
    }

    public function setUUIDMessage(int $UUID_message): static
    {
        $this->UUID_message = $UUID_message;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, Recieve>
     */
    public function getRecieves(): Collection
    {
        return $this->recieves;
    }

    public function addReciefe(Recieve $reciefe): static
    {
        if (!$this->recieves->contains($reciefe)) {
            $this->recieves->add($reciefe);
            $reciefe->setUUIDMessage($this);
        }

        return $this;
    }

    public function removeReciefe(Recieve $reciefe): static
    {
        if ($this->recieves->removeElement($reciefe)) {
            // set the owning side to null (unless already changed)
            if ($reciefe->getUUIDMessage() === $this) {
                $reciefe->setUUIDMessage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Send>
     */
    public function getSends(): Collection
    {
        return $this->sends;
    }

    public function addSend(Send $send): static
    {
        if (!$this->sends->contains($send)) {
            $this->sends->add($send);
            $send->setUUIDMessage($this);
        }

        return $this;
    }

    public function removeSend(Send $send): static
    {
        if ($this->sends->removeElement($send)) {
            // set the owning side to null (unless already changed)
            if ($send->getUUIDMessage() === $this) {
                $send->setUUIDMessage(null);
            }
        }

        return $this;
    }
}
