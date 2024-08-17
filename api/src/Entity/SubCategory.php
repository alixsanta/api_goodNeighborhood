<?php

namespace App\Entity;

use App\Repository\SubCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubCategoryRepository::class)]
class SubCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_sub_category = null;

    #[ORM\Column(length: 50)]
    private ?string $sub_category = null;

    #[ORM\ManyToOne(inversedBy: 'subCategories')]
    private ?Category $id_category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSubCategory(): ?int
    {
        return $this->id_sub_category;
    }

    public function setIdSubCategory(int $id_sub_category): static
    {
        $this->id_sub_category = $id_sub_category;

        return $this;
    }

    public function getSubCategory(): ?string
    {
        return $this->sub_category;
    }

    public function setSubCategory(string $sub_category): static
    {
        $this->sub_category = $sub_category;

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
