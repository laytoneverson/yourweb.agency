<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteStatusRepository")
 */
class WebsiteStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Website", mappedBy="websiteStatus")
     * @var Collection
     */
    private $websites;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusName;

    public function __construct()
    {
        $this->websites = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getStatusName();
    }

    /**
     * @return Collection
     */
    public function getWebsites()
    {
        return $this->websites;
    }

    /**
     * @param Collection $websites
     * @return WebsiteStatus
     */
    public function setWebsites($websites)
    {
        $this->websites = $websites;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * @param string $statusName
     * @return WebsiteStatus
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;

        return $this;
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
     *
     * @return WebsiteStatus
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $website
     */
    public function addWebsite($website)
    {
        $this->websites->add($website);
        $website->setWebsiteStatus($this);
    }

    /**
     * @param mixed $website
     */
    public function removeWebsite($website)
    {
        $this->websites->removeElement($website);
        $website->setWebsiteStatus(null);
    }
}
