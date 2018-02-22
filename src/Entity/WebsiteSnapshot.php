<?php

namespace App\Entity;

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
     * @ORM\OneToOne(targetEntity="App\Entity\StorageAsset", inversedBy="websiteSnapshotFull")
     * @var StorageAsset
     */
    private $fullSizeImageAsset;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StorageAsset", inversedBy="websiteSnapshotThumb")
     * @var StorageAsset
     */
    private $thumbnailImageAsset;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Website", mappedBy="snapshot")
     * @var Website
     */
    private $website;

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
    public function getFullSizeImageAsset(): StorageAsset
    {
        return $this->fullSizeImageAsset;
    }

    /**
     * @param StorageAsset $fullSizeImageAsset
     * @return WebsiteSnapshot
     */
    public function setFullSizeImageAsset(StorageAsset $fullSizeImageAsset): WebsiteSnapshot
    {
        $this->fullSizeImageAsset = $fullSizeImageAsset;

        return $this;
    }

    /**
     * @return StorageAsset
     */
    public function getThumbnailImageAsset(): StorageAsset
    {
        return $this->thumbnailImageAsset;
    }

    /**
     * @param StorageAsset $thumbnailImageAsset
     * @return WebsiteSnapshot
     */
    public function setThumbnailImageAsset(StorageAsset $thumbnailImageAsset): WebsiteSnapshot
    {
        $this->thumbnailImageAsset = $thumbnailImageAsset;

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
     * @return WebsiteSnapshot
     */
    public function setWebsite(Website $website): WebsiteSnapshot
    {
        $this->website = $website;

        return $this;
    }
}
