<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CollectionItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectionItemRepository::class)]
#[ApiResource]
class CollectionItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'collectionItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'collectionItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Monster $monster = null;

    #[ORM\Column]
    private ?bool $isPossessed = null;

    #[ORM\Column]
    private ?bool $isForTrade = null;

    #[ORM\Column]
    private ?\DateTime $addedAt = null;

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

    public function isPossessed(): ?bool
    {
        return $this->isPossessed;
    }

    public function setIsPossessed(bool $isPossessed): static
    {
        $this->isPossessed = $isPossessed;

        return $this;
    }

    public function isForTrade(): ?bool
    {
        return $this->isForTrade;
    }

    public function setIsForTrade(bool $isForTrade): static
    {
        $this->isForTrade = $isForTrade;

        return $this;
    }

    public function getAddedAt(): ?\DateTime
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTime $addedAt): static
    {
        $this->addedAt = $addedAt;

        return $this;
    }
}
