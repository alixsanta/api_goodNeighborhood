<?php

namespace App\Entity;

use App\Repository\DateEventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateEventRepository::class)]
class DateEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_date_event = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column]
    private ?int $id_publication = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDateEvent(): ?int
    {
        return $this->id_date_event;
    }

    public function setIdDateEvent(int $id_date_event): static
    {
        $this->id_date_event = $id_date_event;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
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
}
