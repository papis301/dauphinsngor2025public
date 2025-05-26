<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $uploadedAt = null;

    public function getId(): ?int { return $this->id; }

    public function getFilename(): ?string { return $this->filename; }

    public function setFilename(string $filename): self {
        $this->filename = $filename;
        return $this;
    }

    public function getUploadedAt(): ?\DateTimeImmutable {
        return $this->uploadedAt;
    }

    public function setUploadedAt(\DateTimeImmutable $uploadedAt): self {
        $this->uploadedAt = $uploadedAt;
        return $this;
    }
}
