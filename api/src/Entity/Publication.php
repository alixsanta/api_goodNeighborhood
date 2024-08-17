<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationRepository::class)]
class Publication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_publication = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(length: 100)]
    private ?string $title_publication = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description_publication = null;

    /**
     * @var Collection<int, Link>
     */
    #[ORM\OneToMany(targetEntity: Link::class, mappedBy: 'id_publication')]
    private Collection $links;

    /**
     * @var Collection<int, PostCommentPublication>
     */
    #[ORM\OneToMany(targetEntity: PostCommentPublication::class, mappedBy: 'id_publication')]
    private Collection $postCommentPublications;

    public function __construct()
    {
        $this->links = new ArrayCollection();
        $this->postCommentPublications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPublication(): ?int
    {
        return $this->id_publication;
    }

    public function setIdPublication(int $id_publication): static
    {
        $this->id_publication = $id_publication;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): static
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getTitlePublication(): ?string
    {
        return $this->title_publication;
    }

    public function setTitlePublication(string $title_publication): static
    {
        $this->title_publication = $title_publication;

        return $this;
    }

    public function getDescriptionPublication(): ?string
    {
        return $this->description_publication;
    }

    public function setDescriptionPublication(?string $description_publication): static
    {
        $this->description_publication = $description_publication;

        return $this;
    }

    /**
     * @return Collection<int, Link>
     */
    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Link $link): static
    {
        if (!$this->links->contains($link)) {
            $this->links->add($link);
            $link->setIdPublication($this);
        }

        return $this;
    }

    public function removeLink(Link $link): static
    {
        if ($this->links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getIdPublication() === $this) {
                $link->setIdPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostCommentPublication>
     */
    public function getPostCommentPublications(): Collection
    {
        return $this->postCommentPublications;
    }

    public function addPostCommentPublication(PostCommentPublication $postCommentPublication): static
    {
        if (!$this->postCommentPublications->contains($postCommentPublication)) {
            $this->postCommentPublications->add($postCommentPublication);
            $postCommentPublication->setIdPublication($this);
        }

        return $this;
    }

    public function removePostCommentPublication(PostCommentPublication $postCommentPublication): static
    {
        if ($this->postCommentPublications->removeElement($postCommentPublication)) {
            // set the owning side to null (unless already changed)
            if ($postCommentPublication->getIdPublication() === $this) {
                $postCommentPublication->setIdPublication(null);
            }
        }

        return $this;
    }
}
