<?php
/**
 * Created by PhpStorm.
 * User: layto
 * Date: 2/23/2018
 * Time: 1:48 PM
 */

namespace App\Service\WebsiteClipperService;


use App\AppConstantsInterface;
use App\DBAL\Types\FileFormatType;
use App\Entity\WebsiteSnapshot;
use GuzzleHttp\Client;
use function http_build_query;
use function parse_url;
use const PHP_URL_HOST;
use const PHP_URL_PATH;
use function str_replace;
use function substr;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;
use function urlencode;

class ScreenshotLayerApi implements WebsiteClipperInterface
{
    use WebsiteClipperTrait;

    private $tempFilePath;

    private $apiErrorMessage;

    private $apiUrl;

    private $apiKey;

    /**
     * @var Client
     */
    private $guzzleClient;

    public function __construct(
        $apiUrl = AppConstantsInterface::SCREENSHOTLAYER_API_URL,
        $apiKey = AppConstantsInterface::SCREENSHOTLAYER_API_KEY
    ){
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->guzzleClient = new Client();
    }

    public function clipWebsite($url, $format = FileFormatType::TYPE_IMG_PNG): bool
    {
        $url = 'http://'
            . parse_url($url, PHP_URL_HOST)
            . parse_url($url, PHP_URL_PATH);
        echo $url . "\n";
        $options = [
            'access_key' => $this->apiKey,
            'url' => $url,
            'viewPort' => $this->getViewPortWidth() . "x" . $this->getViewPortHeight(),
            'format' => FileFormatType::getExtension($format),
            'secret_key' => md5($url . AppConstantsInterface::SCREENSHOTLAYER_SECRET_WORD)
        ] ;

        $tempFile = tempnam(sys_get_temp_dir(), "img");

        try {
            $response = $this->guzzleClient->get($this->apiUrl, [
                'query' => $options,
                'sink' => $tempFile,
            ]);
        } catch (\Exception $e) {
            $this->apiErrorMessage = $e->getMessage();
            unlink($tempFile);
            return false;
        }

        $this->tempFilePath = $tempFile;

        return true;
    }

    public function clean(): void
    {
        unlink($this->tempFilePath);
        $this->tempFilePath = null;
        $this->apiErrorMessage = null;
    }

    public function getTempFilePath(): string
    {
        return $this->tempFilePath;
    }

    public function getApiErrorMessage(): string
    {
        return $this->apiErrorMessage;
    }
}
