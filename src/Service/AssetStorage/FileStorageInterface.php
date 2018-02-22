<?php

namespace App\Service\AssetStorage;

use App\Entity\StorageAsset;

interface FileStorageInterface
{
    public function putAsset(StorageAsset $storageAsset);
    public function removeAsset(StorageAsset $storageAsset);
}
