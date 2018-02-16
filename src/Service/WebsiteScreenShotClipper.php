<?php

namespace App\Service;

use App\Entity\Website;
use Screen\Capture;

class WebsiteScreenShotClipper
{
    private $clipper;

    private $saveDir;

    private $savePublicDir = Website::CLIP_BASE_URL;

    public function __construct()
    {
        $this->clipper = new Capture();
    }

    public function clipWebsite(Website $website)
    {
        $this->clipper->setUrl($website->getWebsiteUrl());
        $this->clipper->setClipWidth(800);
        $this->clipper->setClipHeight(600);

        $fileName =
            'site_'. $website->getId()
            . "_" . date('Y-m-d')
            .'.' . $this->clipper->getImageType()->getFormat();

        $this->clipper->save($this->getSaveDir($fileName));
        $website->setWebsiteImageUrl($this->getPublicPath($fileName));

    }

    public function setSaveDir($kernelDir): string
    {
        $this->saveDir = $kernelDir . "/../public" . Website::CLIP_BASE_URL;
    }

    private function getSaveDir($fileName): string
    {
        return $this->saveDir . $this->savePublicDir . $fileName;
    }

    private function getPublicPath($fileName): string
    {
        return $this->savePublicDir . $fileName;
    }
}
