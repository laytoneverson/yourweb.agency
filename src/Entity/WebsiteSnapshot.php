<?php

namespace App\Entity;

use App\AppConstantsInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteSnapshotRepository")
 */
class WebsiteSnapshot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Website", mappedBy="snapshot")
     * @var Website
     */
    private $website;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StorageAsset", inversedBy="websiteSnapshotFull", cascade={"persist"})
     * @var StorageAsset
     */
    private $fullSizeImageAsset;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StorageAsset", inversedBy="websiteSnapshotThumb", cascade={"persist"})
     * @var StorageAsset
     */
    private $thumbnailImageAsset;

    /**
     * @ORM\Column(type="boolean")
     * @var DateTime
     */
    private $snapshotComplete = false;

    public function __toString()
    {
        if ($this->getWebsite()) {
            return $this->getWebsite()->getWebsiteName();
        }

        if ($this->getThumbnailImageAsset()) {
            return (string)$this->getThumbnailImageAsset()->getPublicUrl();
        }

        if ($this->getFullSizeImageAsset()) {
            return (string)$this->getFullSizeImageAsset()->getPublicUrl();
        }

        return "Unknown website";
    }

    public function __construct(Website $website)
    {
        $this->website = $website;
        $website->setSnapshot($this);
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
     * @return WebsiteSnapshot
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return StorageAsset
     */
    public function getFullSizeImageAsset(): ?StorageAsset
    {
        return $this->fullSizeImageAsset;
    }

    /**
     * @param StorageAsset $fullSizeImageAsset
     * @return WebsiteSnapshot
     */
    public function setFullSizeImageAsset(StorageAsset $fullSizeImageAsset): ?WebsiteSnapshot
    {
        $this->fullSizeImageAsset = $fullSizeImageAsset;
        $fullSizeImageAsset->setWebsiteSnapshotFull($this);

        return $this;
    }

    /**
     * @return StorageAsset
     */
    public function getThumbnailImageAsset(): ?StorageAsset
    {
        return $this->thumbnailImageAsset;
    }

    /**
     * @param StorageAsset $thumbnailImageAsset
     * @return WebsiteSnapshot
     */
    public function setThumbnailImageAsset(StorageAsset $thumbnailImageAsset): ?WebsiteSnapshot
    {
        $this->thumbnailImageAsset = $thumbnailImageAsset;
        $thumbnailImageAsset->setWebsiteSnapshotThumb($this);

        return $this;
    }

    /**
     * @return Website
     */
    public function getWebsite(): ?Website
    {
        return $this->website;
    }

    /**
     * @param Website $website
     * @return WebsiteSnapshot
     */
    public function setWebsite(Website $website): WebsiteSnapshot
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getSnapshotComplete(): DateTime
    {
        return $this->snapshotComplete;
    }

    /**
     * @param DateTime $snapshotComplete
     * @return WebsiteSnapshot
     */
    public function setSnapshotComplete(DateTime $snapshotComplete): WebsiteSnapshot
    {
        $this->snapshotComplete = $snapshotComplete;

        return $this;
    }
}
