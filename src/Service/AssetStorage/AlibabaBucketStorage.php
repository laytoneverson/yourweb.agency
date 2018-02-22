<?php

namespace App\Service\AssetStorage;

use App\AppConstantsInterface;
use App\Entity\StorageAsset;
use OSS\OssClient;
use OSS\Core\OssException;

class AlibabaBucketStorage implements FileStorageInterface
{
    private $accessKeyId = '';
    private $accessKeySecret = '';
    private $endpointUrl = '';
    private $client;
    private $bucket;

    public function __construct()
    {
        $this->accessKeyId = AppConstantsInterface::ALIBABA_BUCKET_KEY;
        $this->accessKeySecret = AppConstantsInterface::ALIBABA_BUCKET_SECRET;
        $this->endpointUrl = AppConstantsInterface::ALIBABA_BUCKET_ENDPOINT;
    }

    private function getClient()
    {
        if (null == $this->client) {
            $this->client = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpointUrl, true);
        }

        return $this->client;
    }

    public function putAsset(StorageAsset $storageAsset)
    {

    }

    public function removeAsset(StorageAsset $storageAsset)
    {

    }
}
