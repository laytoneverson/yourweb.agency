<?php

namespace App\Service\WebsiteClipperService;

use App\AppConstantsInterface;
use App\DBAL\Types\FileFormatType;
use App\Entity\Website;
use App\Entity\WebsiteSnapshot;
use App\Service\AssetStorage\AssetStorageManager;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\EntityManagerInterface;
use function file_get_contents;
use function imagecreatefrompng;
use function imagedestroy;
use function imagepng;
use function imagescale;
use function sys_get_temp_dir;
use function tempnam;
use function tmpfile;
use function unlink;


class WebsiteScreenShotClipper
{
    /**
     * @var AssetStorageManager
     */
    private $storageManager;

    /**
     * @var WebsiteClipperInterface
     */
    private $websiteClipper;

    /**
     * @var SlugifyInterface
     */
    private $slugify;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        AssetStorageManager $storageManager,
        WebsiteClipperInterface $websiteClipper,
        SlugifyInterface $slugify,
        EntityManagerInterface $entityManager
    )
    {
        $this->storageManager = $storageManager;
        $this->websiteClipper = $websiteClipper;
        $this->slugify = $slugify;
        $this->entityManager = $entityManager;
    }

    public function clipWebsite(Website $website)
    {
        $websiteSnapshot = new WebsiteSnapshot($website);
        $fileType = FileFormatType::TYPE_IMG_PNG;
        $fileExt = FileFormatType::getExtension($fileType);

        if (!$result = $this->websiteClipper->clipWebsite($website->getWebsiteUrl())){

             throw new \RuntimeException($this->websiteClipper->getApiErrorMessage());
        }
        
        $fullImagePath = $this->websiteClipper->getTempFilePath();
        $fullImageResource = imagecreatefrompng($fullImagePath);
        $thumbResource = imagescale($fullImageResource, AppConstantsInterface::SCRNSHOT_THUMB_WIDTH);
        if ($thumbResource) {
            $thumbPath = tempnam(sys_get_temp_dir(), "THMB");
            imagepng($thumbResource, $thumbPath);
        }
        echo "Full Size Image stored at: $fullImagePath \n";
        echo "Thumbnail stored at $thumbPath";

        try {
            $fileBase = $this->slugify->slugify($website->getWebsiteName());
            $largeFileName = $fileBase
                . AppConstantsInterface::SCRNSHOT_FULL_WIDTH
                . AppConstantsInterface::SCRNSHOT_FULL_HEIGHT
                . $fileExt;
            $thumbFileName = $fileBase
                . AppConstantsInterface::SCRNSHOT_THUMB_WIDTH
                . AppConstantsInterface::SCRNSHOT_THUMB_HEIGHT
                . $fileExt;

            $fullScreenAsset = $this->storageManager->storeAsset($fullImagePath, $largeFileName, $fileType);
            $websiteSnapshot->setFullSizeImageAsset($fullScreenAsset);

            $thumbScreenAsset = $this->storageManager->storeAsset($thumbPath, $thumbFileName, $fileType);
            $websiteSnapshot->setThumbnailImageAsset($fullScreenAsset);


        } catch (\Exception $e) {
            dump($e);
            unlink($this->websiteClipper->getTempFilePath());
            throw new \RuntimeException('Error Storing Captured Website', 600, $e);
        }

        imagedestroy($thumbResource);
        imagedestroy($fullImageResource);

        $this->entityManager->persist($websiteSnapshot);
        $this->entityManager->persist($thumbScreenAsset);
        $this->entityManager->flush();
    }
}
