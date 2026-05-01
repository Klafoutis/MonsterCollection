<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ApiResource]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Monster $monster = null;

    #[ORM\Column]
    private ?int $globalRating = null;

    #[ORM\Column(nullable: true)]
    private ?int $tasteRating = null;

    #[ORM\Column(nullable: true)]
    private ?int $designRating = null;

    #[ORM\Column(nullable: true)]
    private ?int $priceRating = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(length: 20)]
    private ?string $visibility = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getMonster(): ?Monster
    {
        return $this->monster;
    }

    public function setMonster(?Monster $monster): static
    {
        $this->monster = $monster;

        return $this;
    }

    public function getGlobalRating(): ?int
    {
        return $this->globalRating;
    }

    public function setGlobalRating(int $globalRating): static
    {
        $this->globalRating = $globalRating;

        return $this;
    }

    public function getTasteRating(): ?int
    {
        return $this->tasteRating;
    }

    public function setTasteRating(?int $tasteRating): static
    {
        $this->tasteRating = $tasteRating;

        return $this;
    }

    public function getDesignRating(): ?int
    {
        return $this->designRating;
    }

    public function setDesignRating(?int $designRating): static
    {
        $this->designRating = $designRating;

        return $this;
    }

    public function getPriceRating(): ?int
    {
        return $this->priceRating;
    }

    public function setPriceRating(?int $priceRating): static
    {
        $this->priceRating = $priceRating;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    public function setVisibility(string $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
