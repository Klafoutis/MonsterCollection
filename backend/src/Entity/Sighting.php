<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SightingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SightingRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['sighting:read']],
    denormalizationContext: ['groups' => ['sighting:write']]
)]
class Sighting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['sighting:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sightings')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['sighting:read'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'sightings')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['sighting:read'])]
    private ?Monster $monster = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    #[Groups(['sighting:read', 'sighting:write'])]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 11, scale: 8)]
    #[Groups(['sighting:read', 'sighting:write'])]
    private ?string $longitude = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['sighting:read', 'sighting:write'])]
    private ?string $shopName = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['sighting:read', 'sighting:write'])]
    private ?string $city = null;

    #[ORM\Column]
    #[Groups(['sighting:read', 'sighting:write'])]
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

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getShopName(): ?string
    {
        return $this->shopName;
    }

    public function setShopName(?string $shopName): static
    {
        $this->shopName = $shopName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

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
