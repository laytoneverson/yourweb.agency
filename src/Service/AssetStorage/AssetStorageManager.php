<?php

namespace App\Service\AssetStorage;

use App\DBAL\Types\FileFormatType;
use App\Entity\StorageAsset;
use Doctrine\ORM\EntityManagerInterface;
use function in_array;
use function sys_get_temp_dir;

class AssetStorageManager
{
    private  $storageInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AssetStorageManager constructor.
     *
     * @param FileStorageInterface $storageInterface
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(FileStorageInterface $storageInterface, EntityManagerInterface $entityManager)
    {
        $this->storageInterface = $storageInterface;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $filePath
     * @param $fileName
     * @param $fileType
     * @return StorageAsset
     * @throws \Exception
     */
    public function storeAsset($filePath, $fileName, $fileType): StorageAsset
    {
        $storageAsset = new StorageAsset($filePath, $fileName, $fileType);

        try {

            $result = $this->storageInterface->putAsset($storageAsset);

            if (!$result) {
                throw new \Exception("Asset didn't store correctly for an unknown reason");
            }

            $this->entityManager->persist($storageAsset);
            $this->entityManager->flush();

        } catch (\Exception $e) {
            dump($e);
            throw $e;
        }

        return $storageAsset;
    }

    public function removeAsset(StorageAsset $storageAsset)
    {

    }
}
