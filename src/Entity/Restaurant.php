<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="create_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $create_at;

    /**
     * @ORM\ManyToOne(targetEntity=city::class, inversedBy="restaurants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city_id;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="restaurant_id")
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity=RestaurantPicture::class, mappedBy="restaurant_id")
     */
    private $restaurantPictures;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->restaurantPictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getCityId(): ?city
    {
        return $this->city_id;
    }

    public function setCityId(?city $city_id): self
    {
        $this->city_id = $city_id;

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setRestaurantId($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getRestaurantId() === $this) {
                $review->setRestaurantId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RestaurantPicture[]
     */
    public function getRestaurantPictures(): Collection
    {
        return $this->restaurantPictures;
    }

    public function addRestaurantPicture(RestaurantPicture $restaurantPicture): self
    {
        if (!$this->restaurantPictures->contains($restaurantPicture)) {
            $this->restaurantPictures[] = $restaurantPicture;
            $restaurantPicture->setRestaurantId($this);
        }

        return $this;
    }

    public function removeRestaurantPicture(RestaurantPicture $restaurantPicture): self
    {
        if ($this->restaurantPictures->removeElement($restaurantPicture)) {
            // set the owning side to null (unless already changed)
            if ($restaurantPicture->getRestaurantId() === $this) {
                $restaurantPicture->setRestaurantId(null);
            }
        }

        return $this;
    }
}
