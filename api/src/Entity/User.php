<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_MAIL_USER', fields: ['mailUser'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    //#[ORM\Column(length: 50)]
    private Uuid $UUID_user;

    #[ORM\Column(length: 180)]
    private ?string $mailUser = null;

    #[ORM\Column(length: 50)]
    private ?string $first_name_user = null;

    #[ORM\Column(length: 50)]
    private ?string $last_name_user = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image_profil = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

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

    public function getMailUser(): ?string
    {
        return $this->mailUser;
    }

    public function setMailUser(string $mailUser): static
    {
        $this->mailUser = $mailUser;

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->mailUser;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
