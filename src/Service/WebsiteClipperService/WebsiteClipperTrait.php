<?php

namespace App\Service\WebsiteClipperService;

use App\AppConstantsInterface;
use App\DBAL\Types\FileFormatType;

trait WebsiteClipperTrait
{
    /**
     * @var int
     */
    private $imageWidth = AppConstantsInterface::SCRNSHOT_FULL_WIDTH;

    /**
     * @var int
     */
    private $imageHeight = AppConstantsInterface::SCRNSHOT_FULL_HEIGHT;

    /**
     * @var int
     */
    private $viewPortWidth = AppConstantsInterface::SCRNSHOT_VIEWPORT_WIDTH;

    /**
     * @var int
     */
    private $viewPortHeight = AppConstantsInterface::SCRNSHOT_VIEWPORT_HEIGHT;

    /**
     * @var string
     */
    private $format;

    /**
     * @return int
     */
    public function getImageWidth(): int
    {
        return $this->imageWidth;
    }

    /**
     * @param int $imageWidth
     * @return $this
     */
    public function setImageWidth(int $imageWidth)
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageHeight(): int
    {
        return $this->imageHeight;
    }

    /**
     * @param int $imageHeight
     * @return $this
     */
    public function setImageHeight(int $imageHeight)
    {
        $this->imageHeight = $imageHeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewPortWidth(): int
    {
        return $this->viewPortWidth;
    }

    /**
     * @param int $viewPortWidth
     * @return $this
     */
    public function setViewPortWidth(int $viewPortWidth)
    {
        $this->viewPortWidth = $viewPortWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewPortHeight(): int
    {
        return $this->viewPortHeight;
    }

    /**
     * @param int $viewPortHeight
     * @return $this
     */
    public function setViewPortHeight(int $viewPortHeight)
    {
        $this->viewPortHeight = $viewPortHeight;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat(string $format = FileFormatType::TYPE_IMG_PNG)
    {
        $this->format = $format;

        return $this;
    }
}
