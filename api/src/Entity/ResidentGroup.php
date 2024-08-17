<?php

namespace App\Entity;

use App\Repository\ResidentGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResidentGroupRepository::class)]
class ResidentGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $UUID_group = null;

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
    #[ORM\OneToMany(targetEntity: Belong::class, mappedBy: 'UUID_group')]
    private Collection $belongs;

    public function __construct()
    {
        $this->belongs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUUIDGroup(): ?string
    {
        return $this->UUID_group;
    }

    public function setUUIDGroup(string $UUID_group): static
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
    public function getBelongs(): Collection
    {
        return $this->belongs;
    }

    public function addBelong(Belong $belong): static
    {
        if (!$this->belongs->contains($belong)) {
            $this->belongs->add($belong);
            $belong->setUUIDGroup($this);
        }

        return $this;
    }

    public function removeBelong(Belong $belong): static
    {
        if ($this->belongs->removeElement($belong)) {
            // set the owning side to null (unless already changed)
            if ($belong->getUUIDGroup() === $this) {
                $belong->setUUIDGroup(null);
            }
        }

        return $this;
    }
}
