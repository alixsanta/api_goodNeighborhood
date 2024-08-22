<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    //#[ORM\Column(length: 50)]
    private Uuid $UUID_user;

    //private UuidInterface $UUID_user;

    #[ORM\Column(length: 50)]
    private ?string $first_name_user = null;

    #[ORM\Column(length: 50)]
    private ?string $last_name_user = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image_profil = null;

    #[ORM\Column(length: 255)]
    private ?string $mail_user = null;

    #[ORM\Column(length: 250)]
    private ?string $password_user = null;

    /**
     * @var Collection<int, Send>
     */
    #[ORM\OneToMany(targetEntity: Send::class, mappedBy: 'user')]
    private Collection $sends;

    /**
     * @var Collection<int, Belong>
     */
    #[ORM\OneToMany(targetEntity: Belong::class, mappedBy: 'user')]
    private Collection $belongs;

    /**
     * @var Collection<int, Recieve>
     */
    #[ORM\OneToMany(targetEntity: Recieve::class, mappedBy: 'user')]
    private Collection $recieves;

    public function __construct()
    {
        $UUID_user = Uuid::v6();
        $this->sends = new ArrayCollection();
        $this->belongs = new ArrayCollection();
        $this->recieves = new ArrayCollection();
    }


    public function getUUIDUser(): ?Uuid
    {
        return $this->UUID_user;
    }

    public function setUUIDUser(UuidInterface $UUID_user): self
    {
        $this->UUID_user = $UUID_user;

        return $this;
    }

    public function getFirstNameUser(): ?string
    {
        return $this->first_name_user;
    }

    public function setFirstNameUser(string $first_name_user): static
    {
        $this->first_name_user = $first_name_user;

        return $this;
    }

    public function getLastNameUser(): ?string
    {
        return $this->last_name_user;
    }

    public function setLastNameUser(string $last_name_user): static
    {
        $this->last_name_user = $last_name_user;

        return $this;
    }

    public function getImageProfil(): ?string
    {
        return $this->image_profil;
    }

    public function setImageProfil(?string $image_profil): static
    {
        $this->image_profil = $image_profil;

        return $this;
    }

    public function getMailUser(): ?string
    {
        return $this->mail_user;
    }

    public function setMailUser(string $mail_user): static
    {
        $this->mail_user = $mail_user;

        return $this;
    }

    public function getPasswordUser(): ?string
    {
        return $this->password_user;
    }

    public function setPasswordUser(string $password_user): static
    {
        $this->password_user = $password_user;

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
            $send->setUser($this);
        }

        return $this;
    }

    public function removeSend(Send $send): static
    {
        if ($this->sends->removeElement($send)) {
            // set the owning side to null (unless already changed)
            if ($send->getUser() === $this) {
                $send->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Belong>
     */
    public function getBelongs(): Collection
    {
        return $this->belongs;
    }

    public function addBelong(Belong $belong): static
    {
        if (!$this->belongs->contains($belong)) {
            $this->belongs->add($belong);
            $belong->setUser($this);
        }

        return $this;
    }

    public function removeBelong(Belong $belong): static
    {
        if ($this->belongs->removeElement($belong)) {
            // set the owning side to null (unless already changed)
            if ($belong->getUser() === $this) {
                $belong->setUser(null);
            }
        }

        return $this;
    }

    public function addRecieve(Recieve $recieve): static
    {
        if (!$this->recieves->contains($recieve)) {
            $this->recieves->add($recieve);
            $recieve->setUser($this);
        }

        return $this;
    }

    public function removeRecieve(Recieve $recieve): static
    {
        if ($this->recieves->removeElement($recieve)) {
            // set the owning side to null (unless already changed)
            if ($recieve->getUser() === $this) {
                $recieve->setUser(null);
            }
        }

        return $this;
    }
}
