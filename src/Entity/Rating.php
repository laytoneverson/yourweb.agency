<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 */
class Rating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Website", inversedBy="websiteRatings")
     * @var Website
     */
    private $website;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUser", inversedBy="ratings")
     * @var AppUser
     */
    private $appUser;

    /**
     * @ORM\Column(type="decimal", scale=1)
     * @var float
     */
    private $starRating = 2.5;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $comment;

    public function __toString()
    {
        return $this->getStarRating() . ' / 5';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Rating
     */
    public function setId($id): Rating
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Website
     */
    public function getWebsite(): Website
    {
        return $this->website;
    }

    /**
     * @param Website $website
     * @return Rating
     */
    public function setWebsite(Website $website): Rating
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return float
     */
    public function getStarRating(): float
    {
        return $this->starRating;
    }

    /**
     * @param float $starRating
     * @return Rating
     */
    public function setStarRating(float $starRating): Rating
    {
        $starRating = round($starRating, 1);

        if ($starRating > 5.0) {
            $starRating = 5.0;
        }

        if ($starRating < 0.0) {
            $starRating = 0.0;
        }

        $this->starRating = $starRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Rating
     */
    public function setComment(string $comment): Rating
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return AppUser
     */
    public function getAppUser(): AppUser
    {
        return $this->appUser;
    }

    /**
     * @param AppUser $user
     * @return Rating
     */
    public function setAppUser(AppUser $user = null): Rating
    {
        $this->appUser = $user;

        return $this;
    }
}
