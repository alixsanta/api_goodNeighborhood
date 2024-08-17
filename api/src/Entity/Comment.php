<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_comment = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(length: 50)]
    private ?string $UUID_user = null;

    /**
     * @var Collection<int, PostCommentPublication>
     */
    #[ORM\OneToMany(targetEntity: PostCommentPublication::class, mappedBy: 'id_comment')]
    private Collection $postCommentPublications;

    public function __construct()
    {
        $this->postCommentPublications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdComment(): ?int
    {
        return $this->id_comment;
    }

    public function setIdComment(int $id_comment): static
    {
        $this->id_comment = $id_comment;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

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
            $postCommentPublication->setIdComment($this);
        }

        return $this;
    }

    public function removePostCommentPublication(PostCommentPublication $postCommentPublication): static
    {
        if ($this->postCommentPublications->removeElement($postCommentPublication)) {
            // set the owning side to null (unless already changed)
            if ($postCommentPublication->getIdComment() === $this) {
                $postCommentPublication->setIdComment(null);
            }
        }

        return $this;
    }
}
