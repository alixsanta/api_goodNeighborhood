<?php

namespace App\Entity;

use App\Repository\ResidentGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: ResidentGroupRepository::class)]
class ResidentGroup
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    //#[ORM\Column(length: 50)]
    private Uuid $UUID_group;

    #[ORM\Column(length: 50)]
    private ?string $name_group = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_group = null;

    #[ORM\Column]
    private ?int $id_address = null;

    #[ORM\Column(length: 50)]
    private ?string $UUID_user = null;

    /**
     * @var Collection<int, Belong>
     */
    #[ORM\ManyToMany(targetEntity:User::class, mappedBy:'group')]
    //#[ORM\JoinTable(name:"belong")]
    private Collection $users;

    public function __construct()
    {
        $UUID_group = Uuid::v6();
        $this->users = new ArrayCollection();
    }


    public function getUUIDGroup(): ?Uuid
    {
        return $this->UUID_group;
    }

    public function setUUIDGroup(Uuid $UUID_group): self
    {
        $this->UUID_group = $UUID_group;

        return $this;
    }

    public function getNameGroup(): ?string
    {
        return $this->name_group;
    }

    public function setNameGroup(string $name_group): static
    {
        $this->name_group = $name_group;

        return $this;
    }

    public function getImageGroup(): ?string
    {
        return $this->image_group;
    }

    public function setImageGroup(?string $image_group): static
    {
        $this->image_group = $image_group;

        return $this;
    }

    public function getIdAddress(): ?int
    {
        return $this->id_address;
    }

    public function setIdAddress(int $id_address): static
    {
        $this->id_address = $id_address;

        return $this;
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

    /**
     * @return Collection<int, Belong>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addGroup($this);
        }

        return $this;
    }


    public function removeBelong(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUUIDUser() === $this) {
                $user->setUUIDUser($this);
            }
        }

        return $this;
    }
}
