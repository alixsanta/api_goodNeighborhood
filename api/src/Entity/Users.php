<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 50)]
    private ?string $UUID_user = null;

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
    #[ORM\OneToMany(targetEntity: Send::class, mappedBy: 'UUID_user')]
    private Collection $sends;

    /**
     * @var Collection<int, Belong>
     */
    #[ORM\OneToMany(targetEntity: Belong::class, mappedBy: 'UUID_user')]
    private Collection $belongs;

    public function __construct()
    {
        $this->sends = new ArrayCollection();
        $this->belongs = new ArrayCollection();
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
            $send->setUUIDUser($this);
        }

        return $this;
    }

    public function removeSend(Send $send): static
    {
        if ($this->sends->removeElement($send)) {
            // set the owning side to null (unless already changed)
            if ($send->getUUIDUser() === $this) {
                $send->setUUIDUser(null);
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
            $belong->setUUIDUser($this);
        }

        return $this;
    }

    public function removeBelong(Belong $belong): static
    {
        if ($this->belongs->removeElement($belong)) {
            // set the owning side to null (unless already changed)
            if ($belong->getUUIDUser() === $this) {
                $belong->setUUIDUser(null);
            }
        }

        return $this;
    }
}
