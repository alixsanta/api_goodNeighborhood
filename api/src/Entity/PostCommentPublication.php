<?php

namespace App\Entity;

use App\Repository\PostCommentPublicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostCommentPublicationRepository::class)]
class PostCommentPublication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'postCommentPublications')]
    private ?Comment $id_comment = null;

    #[ORM\ManyToOne(inversedBy: 'postCommentPublications')]
    private ?Publication $id_publication = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdComment(): ?Comment
    {
        return $this->id_comment;
    }

    public function setIdComment(?Comment $id_comment): static
    {
        $this->id_comment = $id_comment;

        return $this;
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
}
