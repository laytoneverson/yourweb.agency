<?php

namespace App\Entity;

use App;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteRepository")
 */
class Website
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Website Category
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\WebsiteCategory", inversedBy="websites")
     * @var Collection
     */
    private $websiteCategories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WebsiteStatus")
     * @var App\Entity\WebsiteStatus
     */
    private $websiteStatus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="website")
     * @var Collection
     */
    private $websiteRatings;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $websiteName = '';

    /**
    * @ORM\Column(type="string", length=255)
    * @var string
    */
    private $websiteUrl = "http://";

    /**
    * @ORM\Column(type="string", length=255)
    * @var string
    */
    private $websiteImageUrl = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $websiteSummary = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $websiteReview = '';

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $myRecommendation = 5;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $averageRating = 2.5;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @var float
     */
    private $websiteFriendlyRating = 2.5;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @var float
     */
    private $websiteSafetyRating = 2.5;

    /**
     *
     * @var 
     */
    private $currenciesAccepted;


    public function __toString()
    {
        return $this->getWebsiteUrl();
    }

    public function __construct()
    {
        $this->websiteRatings = new ArrayCollection();
        $this->websiteCategories = new ArrayCollection();
        $this->currenciesAccepted = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Website
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getWebsiteCategories(): Collection
    {
        return $this->websiteCategories;
    }

    /**
     * @param Collection $websiteCategories
     * @return Website
     */
    public function setWebsiteCategories(Collection $websiteCategories): Website
    {
        $this->websiteCategories = $websiteCategories;

        return $this;
    }

    /**
     * @return WebsiteStatus
     */
    public function getWebsiteStatus(): ?WebsiteStatus
    {
        return $this->websiteStatus;
    }

    /**
     * @param WebsiteStatus $websiteStatus
     * @return Website
     */
    public function setWebsiteStatus(WebsiteStatus $websiteStatus): Website
    {
        $this->websiteStatus = $websiteStatus;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getWebsiteRatings(): Collection
    {
        return $this->websiteRatings;
    }

    /**
     * @param Collection $websiteRatings
     * @return Website
     */
    public function setWebsiteRatings(Collection $websiteRatings): Website
    {
        $this->websiteRatings = $websiteRatings;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteName(): string
    {
        return $this->websiteName;
    }

    /**
     * @param string $websiteName
     * @return Website
     */
    public function setWebsiteName(string $websiteName): Website
    {
        $this->websiteName = $websiteName;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteUrl(): string
    {
        return $this->websiteUrl;
    }

    /**
     * @param string $websiteUrl
     * @return Website
     */
    public function setWebsiteUrl(string $websiteUrl): Website
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteImageUrl(): string
    {
        return $this->websiteImageUrl;
    }

    /**
     * @param string $websiteImageUrl
     * @return Website
     */
    public function setWebsiteImageUrl(string $websiteImageUrl): Website
    {
        $this->websiteImageUrl = $websiteImageUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteSummary(): string
    {
        return $this->websiteSummary;
    }

    /**
     * @param string $websiteSummary
     * @return Website
     */
    public function setWebsiteSummary(string $websiteSummary): Website
    {
        $this->websiteSummary = $websiteSummary;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteReview(): string
    {
        return $this->websiteReview;
    }

    /**
     * @param string $websiteReview
     * @return Website
     */
    public function setWebsiteReview(string $websiteReview): Website
    {
        $this->websiteReview = $websiteReview;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAverageRating()
    {
        return $this->averageRating;
    }

    /**
     * @param mixed $averageRating
     * @return Website
     */
    public function setAverageRating($averageRating)
    {
        $this->averageRating = $averageRating;

        return $this;
    }

    /**
     * @return int
     */
    public function getMyRecommendation(): int
    {
        return $this->myRecommendation;
    }

    /**
     * @param int $myRecommendation
     * @return Website
     */
    public function setMyRecommendation(int $myRecommendation): Website
    {
        $this->myRecommendation = $myRecommendation;

        return $this;
    }

    /**
     * @param mixed $websiteCategory
     */
    public function addWebsiteCategory($websiteCategory)
    {
        $this->websiteCategories->add($websiteCategory);
        // uncomment if you want to update other side
        $websiteCategory->setWebsite($this);
    }

    /**
     * @param mixed $websiteCategory
     */
    public function removeWebsiteCategory($websiteCategory)
    {
        $this->websiteCategories->removeElement($websiteCategory);
        // uncomment if you want to update other side
        $websiteCategory->setWebsite(null);
    }

    /**
     * @param mixed $websiteRating
     */
    public function addWebsiteRating($websiteRating)
    {
        $this->websiteRatings->add($websiteRating);
        // uncomment if you want to update other side
        $websiteRating->setWebsite($this);
    }

    /**
     * @param mixed $websiteRating
     */
    public function removeWebsiteRating($websiteRating)
    {
        $this->websiteRatings->removeElement($websiteRating);
        // uncomment if you want to update other side
        $websiteRating->setWebsite(null);
    }
}
