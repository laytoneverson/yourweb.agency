<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

class ShrinkTheWebApi
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
