<?php

namespace App\Service\WebsiteClipperService;

use App\AppConstantsInterface;
use App\DBAL\Types\FileFormatType;
use App\Entity\WebsiteSnapshot;

interface WebsiteClipperInterface
{
    public function clipWebsite($url, $format = FileFormatType::TYPE_IMG_PNG): bool;

    public function setImageWidth(int $width);
    public function setImageHeight(int $height);

    public function setViewPortWidth(int $width);
    public function setViewPortHeight(int $height);

    public function setFormat(string $format = FileFormatType::TYPE_IMG_PNG);

    public function getTempFilePath(): string;
    public function getApiErrorMessage(): string;

    public function clean();
}
