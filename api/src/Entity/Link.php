<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'links')]
    private ?Publication $id_publication = null;

    #[ORM\ManyToOne(inversedBy: 'links')]
    private ?Category $id_category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPublication(): ?Publication
    {
        return $this->id_publication;
    }

    public function setIdPublication(?Publication $id_publication): static
    {
        $this->id_publication = $id_publication;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->id_category;
    }

    public function setIdCategory(?Category $id_category): static
    {
        $this->id_category = $id_category;

        return $this;
    }
}
