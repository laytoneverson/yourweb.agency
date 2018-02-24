<?php

namespace App\Service\AssetStorage;

use App\AppConstantsInterface;
use App\DBAL\Types\FileFormatType;
use App\Entity\StorageAsset;
use Cocur\Slugify\Slugify;
use Cocur\Slugify\SlugifyInterface;
use OSS\OssClient;
use OSS\Core\OssException;

class AlibabaBucketStorage implements FileStorageInterface
{
    private $accessKeyId = '';
    private $accessKeySecret = '';
    private $endpointUrl = '';
    private $client;
    private $bucket;
    
    /**
     * @var SlugifyInterface
     */
    private $slugify;

    public function __construct(SlugifyInterface $slugify)
    {
        $this->accessKeyId = AppConstantsInterface::ALIBABA_BUCKET_KEY;
        $this->accessKeySecret = AppConstantsInterface::ALIBABA_BUCKET_SECRET;
        $this->endpointUrl = AppConstantsInterface::ALIBABA_BUCKET_ENDPOINT;
        $this->bucket = AppConstantsInterface::ALIBABA_BUCKET_NAME;
        $this->slugify = $slugify;
    }

    private function getClient()
    {
        if (null == $this->client) {
            $this->client = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpointUrl, true);
        }

        return $this->client;
    }

    /**
     * @param StorageAsset $storageAsset
     * @return bool
     * @throws \Exception
     */
    public function putAsset(StorageAsset $storageAsset): bool
    {
        $fileExt = ".". FileFormatType::getExtensions()[$storageAsset->getFileType()];
        $key = "assets/". $this->slugify->slugify($storageAsset->getFileName()). $fileExt;

        try {
            $this->getClient()->uploadFile($this->bucket, $key, $storageAsset->getTempFilePath());
        } catch (\Exception $e) {
            dump($e);

            throw $e;
        }
        
        $storageAsset->setStorageKey($key)
            ->setUploadDate(new \DateTime())
            ->setPublicUrl($this->endpointUrl. "/" . $key);

        return true;
    }

    public function removeAsset(StorageAsset $storageAsset)
    {

    }
}
