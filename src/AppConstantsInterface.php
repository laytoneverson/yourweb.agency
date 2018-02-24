<?php
/**
 * Created by PhpStorm.
 * User: layto
 * Date: 2/21/2018
 * Time: 3:13 AM
 */

namespace App;

interface AppConstantsInterface
{
    /* Alibab bucket storage creds  */
    public const ALIBABA_BUCKET_NAME = 'cryptocurrency-db';
    public const ALIBABA_BUCKET_KEY = 'LTAIJu9zM8pdrbY8';
    public const ALIBABA_BUCKET_SECRET = 'KmXHC1kSR4NJpVZzZgr93K6dqsx77I';
    public const ALIBABA_BUCKET_ENDPOINT = 'crypto-assets.yourweb.online';

    /* Website screen shot image sizes */
    public const SCRNSHOT_FULL_WIDTH = '450';
    public const SCRNSHOT_FULL_HEIGHT = '280';
    public const SCRNSHOT_THUMB_WIDTH = '225';
    public const SCRNSHOT_THUMB_HEIGHT = '140';
    public const SCRNSHOT_VIEWPORT_WIDTH = '1350';
    public const SCRNSHOT_VIEWPORT_HEIGHT = '840';

    /* Screenshot Layer*/
    public const SCREENSHOTLAYER_API_KEY = '477623c96899d7813367aee7010a899a';
    public const SCREENSHOTLAYER_SECRET_WORD = 'yourwebsecret';
    public const SCREENSHOTLAYER_API_URL = 'http://api.screenshotlayer.com/api/capture';
}
