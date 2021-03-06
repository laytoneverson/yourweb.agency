<?php

namespace App\Entity;

use App;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteCategoryRepository")
 */
class WebsiteCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Website", mappedBy="websiteCategories")
     * @var Collection
     */
    private $websites;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $categoryName;

    /**
     * @Gedmo\Slug(fields={"categoryName"})
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $categorySlug;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $categorySummary;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $categorySummaryExtended;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $categoryKeyWords;

    public function getSlug()
    {
        return $this->getCategorySlug();
    }

    public function __construct()
    {
        $this->websites = new ArrayCollection();
    }

    public function __toString()
    {
        return ''. $this->getCategoryName();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return WebsiteCategory
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getWebsites(): Collection
    {
        return $this->websites;
    }

    /**
     * @param string $websites
     * @return WebsiteCategory
     */
    public function setWebsites($websites)
    {
        $this->websites = $websites;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     * @return WebsiteCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @param Website $website
     */
    public function addWebsite($website)
    {
        $this->websites->add($website);
    }

    /**
     * @param Website $website
     */
    public function removeWebsite($website)
    {
        $this->websites->removeElement($website);
    }

    /**
     * @return string
     */
    public function getCategorySummary(): ?string
    {
        return $this->categorySummary;
    }

    /**
     * @param string $categorySummary
     */
    public function setCategorySummary(string $categorySummary): WebsiteCategory
    {
        $this->categorySummary = $categorySummary;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategorySlug(): ?string
    {
        return $this->categorySlug;
    }

    /**
     * @param string $categorySlug
     * @return WebsiteCategory
     */
    public function setCategorySlug(string $categorySlug): WebsiteCategory
    {
        $this->categorySlug = $categorySlug;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryKeyWords(): ?string
    {
        return $this->categoryKeyWords;
    }

    /**
     * @param string $categoryKeyWords
     */
    public function setCategoryKeyWords(string $categoryKeyWords): void
    {
        $this->categoryKeyWords = $categoryKeyWords;
    }

    /**
     * @return string
     */
    public function getCategorySummaryExtended(): ?string
    {
        return $this->categorySummaryExtended;
    }

    /**
     * @param string $categorySummaryExtended
     * @return WebsiteCategory
     */
    public function setCategorySummaryExtended(string $categorySummaryExtended): WebsiteCategory
    {
        $this->categorySummaryExtended = $categorySummaryExtended;

        return $this;
    }
}
