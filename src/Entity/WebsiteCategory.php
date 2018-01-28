<?php

namespace App\Entity;

use App;
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
     * @var ArrayCollection
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

    public function __construct()
    {
        $this->websites = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getCategoryName();
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
     * @return WebsiteCategory
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsites()
    {
        return $this->websites;
    }

    /**
     * @param mixed $websites
     * @return WebsiteCategory
     */
    public function setWebsites($websites)
    {
        $this->websites = $websites;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param mixed $categoryName
     * @return WebsiteCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @param mixed $website
     */
    public function addWebsite($website)
    {
        $this->websites->add($website);
        $website->setWebsiteCategory($this);
    }

    /**
     * @param mixed $website
     */
    public function removeWebsite($website)
    {
        $this->websites->removeElement($website);
        $website->setWebsiteCategory(null);
    }

    /**
     * @return string
     */
    public function getCategorySummary(): string
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
    public function getCategorySlug(): string
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
}
