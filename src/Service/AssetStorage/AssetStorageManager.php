<?php

namespace App\Service\AssetStorage;


use function sem_acquire;
use function sys_get_temp_dir;

class AssetStorageManager
{


    public function storeAsset($filePath, $fileName, $assetType)
    {

    }

    public function writeTempFile($fileData, $fileName, $assetType)
    {
        $tempDir = sys_get_temp_dir();

    }
}
