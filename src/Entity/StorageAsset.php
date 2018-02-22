<?php

namespace App\Entity;

use App\DBAL\Types\FileFormatType;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StorageAssetRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class StorageAsset
{
    use TimeStampableTrait, SoftDeletableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WebsiteSnapshot", mappedBy="fullSizeImageAsset")
     * @var WebsiteSnapshot
     */
    private $websiteSnapshotThumb;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WebsiteSnapshot", mappedBy="WebsiteSnapshot")
     * @var WebsiteSnapshot
     */
    private $websiteSnapshotFull;

    /**
     * @var mixed
     */
    protected $fileData;

    /**
     * @var string
     */
    protected $tempFilePath;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @var DateTime
     */
    private $uploadDate;

    /**
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\FileFormatType")
     * @ORM\Column(type="FileFormatType", nullable=false)
     * @var string
     */
    protected $fileType;

    /**
     * Name of the file used for download or local storage
     *
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $fileName;

    /**
     * Value used to identify the file in the storage service
     *
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $storageKey;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $publicUrl;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return StorageAsset
     */
    public function setId($id): StorageAsset
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileData()
    {
        return $this->fileData;
    }

    /**
     * @param mixed $fileData
     * @return StorageAsset
     */
    public function setFileData($fileData): StorageAsset
    {
        $this->fileData = $fileData;

        return $this;
    }

    /**
     * @return string
     */
    public function getTempFilePath(): ?string
    {
        return $this->tempFilePath;
    }

    /**
     * @param string $tempFilePath
     * @return StorageAsset
     */
    public function setTempFilePath(string $tempFilePath): StorageAsset
    {
        $this->tempFilePath = $tempFilePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileType(): ?string
    {
        return $this->fileType;
    }

    /**
     * @param string $fileType
     * @return StorageAsset
     */
    public function setFileType(string $fileType): StorageAsset
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return StorageAsset
     */
    public function setFileName(string $fileName): StorageAsset
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getStorageKey(): ?string
    {
        return $this->storageKey;
    }

    /**
     * @param string $storageKey
     * @return StorageAsset
     */
    public function setStorageKey(string $storageKey): StorageAsset
    {
        $this->storageKey = $storageKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublicUrl(): ?string
    {
        return $this->publicUrl;
    }

    /**
     * @param string $publicUrl
     * @return StorageAsset
     */
    public function setPublicUrl(string $publicUrl): StorageAsset
    {
        $this->publicUrl = $publicUrl;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUploadDate(): ?DateTime
    {
        return $this->uploadDate;
    }

    /**
     * @param DateTime $uploadDate
     * @return StorageAsset
     */
    public function setUploadDate(DateTime $uploadDate): StorageAsset
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    /**
     * @return WebsiteSnapshot
     */
    public function getWebsiteSnapshotThumb(): WebsiteSnapshot
    {
        return $this->websiteSnapshotThumb;
    }

    /**
     * @param WebsiteSnapshot $websiteSnapshotThumb
     * @return StorageAsset
     */
    public function setWebsiteSnapshotThumb(WebsiteSnapshot $websiteSnapshotThumb): StorageAsset
    {
        $this->websiteSnapshotThumb = $websiteSnapshotThumb;

        return $this;
    }

    /**
     * @return WebsiteSnapshot
     */
    public function getWebsiteSnapshotFull(): WebsiteSnapshot
    {
        return $this->websiteSnapshotFull;
    }

    /**
     * @param WebsiteSnapshot $websiteSnapshotFull
     * @return StorageAsset
     */
    public function setWebsiteSnapshotFull(WebsiteSnapshot $websiteSnapshotFull): StorageAsset
    {
        $this->websiteSnapshotFull = $websiteSnapshotFull;

        return $this;
    }
}
