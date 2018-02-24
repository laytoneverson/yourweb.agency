<?php

namespace App\Service\AssetStorage;

use App\Entity\StorageAsset;

interface FileStorageInterface
{
    public function putAsset(StorageAsset $storageAsset): bool;
    public function removeAsset(StorageAsset $storageAsset);
}
