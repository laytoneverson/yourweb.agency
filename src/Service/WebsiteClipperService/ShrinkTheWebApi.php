<?php

namespace App\Service\WebsiteClipperService;

use App\DBAL\Types\FileFormatType;
use App\Service\WebsiteClipperService\WebsiteClipperInterface;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

class ShrinkTheWebApi #implements WebsiteClipperInterface
{
    public const SIZE_75X56 = 'mcr';
    public const SIZE_90X68 = 'tny';
    public const SIZE_100X75 = 'vsm';
    public const SIZE_120X90 = 'sm';
    public const SIZE_200X150 = 'lg';
    public const SIZE_320X240 = 'xlg';
    public const SIZE_DEFAULT = '450X280';

    public const FORMAT_XML = 'xml';
    public const FORMAT_JSON = 'json';

    private const ACCESS_KEY = '5063594be9ca09a';
    private const API_SECRET = '11a9277ac96daf3a5212bce55a19ca12';

    private const API_URL = 'http://images.shrinktheweb.com/xino.php';

    private $entityManager;

    private $client;

    private $options = [
        'stwu' => self::API_SECRET,
        'stwaccesskeyid' => self::ACCESS_KEY,
        'stwsize' => self::SIZE_DEFAULT,
        'stwfull' => '0',
    ];

    private $captureUrl;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->client = new Client();
    }

    public function clipWebsite($url, $format = FileFormatType::TYPE_IMG_PNG): bool
    {
        // TODO: Implement clipWebsite() method.
    }

    public function setImageWidth(int $width)
    {
        // TODO: Implement setImageWidth() method.
    }

    public function setImageHeight(int $height)
    {
        // TODO: Implement setImageHeight() method.
    }

    public function setViewPortWidth(int $width)
    {
        // TODO: Implement setViewPortWidth() method.
    }

    public function setViewPortHeight(int $height)
    {
        // TODO: Implement setViewPortHeight() method.
    }

    public function setFormat(string $format = FileFormatType::TYPE_IMG_PNG)
    {
        // TODO: Implement setFormat() method.
    }

    public function getScreenshotUrl(): string
    {
        // TODO: Implement getScreenshotUrl() method.
    }

    public function getApiErrorMessage(): string
    {
        // TODO: Implement getApiErrorMessage() method.
    }


    public function getImage($captureUrl, $options = [])
    {
        $this->options = $options;
        $this->captureUrl = $captureUrl;

        $apiPattern = '';
    }

    private function getToken($url)
    {
        $secret = self::apiSecret;
        $token = md5($this->getUrlString($url) . $secret);
    }

    private function getUrlString($url): string
    {
        return "url={$url}&mode=page";
    }
}
