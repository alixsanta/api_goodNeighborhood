<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    //#[ORM\Id]
    #[ORM\Column(type: String::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    //#[ORM\Column(length: 50)]
    private ?string $uuid_user;

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
    #[ORM\JoinColumn(nullable: false)]
    private Collection $sends;


    /**
     * @var Collection<int, Belong>
     */
    #[ORM\ManyToMany(targetEntity:ResidentGroup::class, inversedBy:'user')]
    #[ORM\JoinTable(name:"belong")]
    private Collection $groups;


    /**
     * @var Collection<int, Recieve>
     */
    #[ORM\OneToMany(targetEntity: Recieve::class, mappedBy: 'user')]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $recieves;

    public function __construct()
    {
        $uuid_user = Uuid::v6();
        $this->groups = new ArrayCollection();
        $this->sends = new ArrayCollection();
        $this->recieves = new ArrayCollection();
    }


    public function getUUIDUser(): ?string
    {
        return $this->uuid_user;
    }

    public function setUUIDUser(string $uuid_user): self
    {
        $this->uuid_user = $uuid_user;

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
    public function getGroup(): Collection
    {
        return $this->groups;
    }

    public function addGroup(ResidentGroup $group): static
    {
        if (!$this->groups->contains($group)) {
            $this->groups->add($group);
            $group->addUser($this);
        }

        return $this;
    }

    public function removeGroup(ResidentGroup $group): static
    {
        if ($this->groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getUUIDGroup() === $this) {
                $group->setUUIDGroup($this);
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
