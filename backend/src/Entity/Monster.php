<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MonsterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: MonsterRepository::class)]
#[ApiResource]
class Monster
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true, unique: true)]
    private ?string $ean = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Gedmo\Translatable]
    private ?string $flavor = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Gedmo\Translatable]
    private ?string $origin = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Gedmo\Translatable]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $release_year = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $is_discontinued = null;

    #[ORM\Column(nullable: true)]
    private ?float $estimated_value = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'submittedMonsters')]
    private ?User $submittedBy = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $created_at = null;

    /**
     * @var Collection<int, CollectionItem>
     */
    #[ORM\OneToMany(targetEntity: CollectionItem::class, mappedBy: 'monster')]
    private Collection $collectionItems;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'monster')]
    private Collection $reviews;

    /**
     * @var Collection<int, Sighting>
     */
    #[ORM\OneToMany(targetEntity: Sighting::class, mappedBy: 'monster')]
    private Collection $sightings;

    #[ORM\Column(length: 50)]
    private ?string $rarity = null;

    public function __construct()
    {
        $this->collectionItems = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->sightings = new ArrayCollection();
    }

    #[Gedmo\Locale]
    private string $locale = 'fr';

    public function setTranslatableLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): static
    {
        $this->ean = $ean;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFlavor(): ?string
    {
        return $this->flavor;
    }

    public function setFlavor(string $flavor): static
    {
        $this->flavor = $flavor;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->release_year;
    }

    public function setReleaseYear(?int $release_year): static
    {
        $this->release_year = $release_year;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isDiscontinued(): ?bool
    {
        return $this->is_discontinued;
    }

    public function setIsDiscontinued(bool $is_discontinued): static
    {
        $this->is_discontinued = $is_discontinued;

        return $this;
    }

    public function getEstimatedValue(): ?float
    {
        return $this->estimated_value;
    }

    public function setEstimatedValue(?float $estimated_value): static
    {
        $this->estimated_value = $estimated_value;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getSubmittedBy(): ?User
    {
        return $this->submittedBy;
    }

    public function setSubmittedBy(?User $submittedBy): static
    {
        $this->submittedBy = $submittedBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTime $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, CollectionItem>
     */
    public function getCollectionItems(): Collection
    {
        return $this->collectionItems;
    }

    public function addCollectionItem(CollectionItem $collectionItem): static
    {
        if (!$this->collectionItems->contains($collectionItem)) {
            $this->collectionItems->add($collectionItem);
            $collectionItem->setMonster($this);
        }

        return $this;
    }

    public function removeCollectionItem(CollectionItem $collectionItem): static
    {
        if ($this->collectionItems->removeElement($collectionItem)) {
            // set the owning side to null (unless already changed)
            if ($collectionItem->getMonster() === $this) {
                $collectionItem->setMonster(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setMonster($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getMonster() === $this) {
                $review->setMonster(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sighting>
     */
    public function getSightings(): Collection
    {
        return $this->sightings;
    }

    public function addSighting(Sighting $sighting): static
    {
        if (!$this->sightings->contains($sighting)) {
            $this->sightings->add($sighting);
            $sighting->setMonster($this);
        }

        return $this;
    }

    public function removeSighting(Sighting $sighting): static
    {
        if ($this->sightings->removeElement($sighting)) {
            // set the owning side to null (unless already changed)
            if ($sighting->getMonster() === $this) {
                $sighting->setMonster(null);
            }
        }

        return $this;
    }

    public function getRarity(): ?string
    {
        return $this->rarity;
    }

    public function setRarity(string $rarity): static
    {
        $this->rarity = $rarity;

        return $this;
    }
}
