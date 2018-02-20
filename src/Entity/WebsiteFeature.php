<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteFeatureRepository")
 */
class WebsiteFeature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Website", inversedBy="websiteFeatures")
     * @var Collection
     */
    private $websites;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $featureLabel = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $featureDescription;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return WebsiteFeature
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsites()
    {
        return $this->websites;
    }

    /**
     * @param mixed $websites
     * @return WebsiteFeature
     */
    public function setWebsites($websites)
    {
        $this->websites = $websites;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeatureLabel(): string
    {
        return $this->featureLabel;
    }

    /**
     * @param string $featureLabel
     * @return WebsiteFeature
     */
    public function setFeatureLabel(string $featureLabel): WebsiteFeature
    {
        $this->featureLabel = $featureLabel;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeatureDescription(): ?string
    {
        return $this->featureDescription;
    }

    /**
     * @param string $featureDescription
     * @return WebsiteFeature
     */
    public function setFeatureDescription(string $featureDescription): WebsiteFeature
    {
        $this->featureDescription = $featureDescription;

        return $this;
    }

    /**
     * @param Website $website
     */
    public function addWebsite($website)
    {
        $this->websites->add($website);
        $website->addWebsiteFeature($this);
    }

    /**
     * @param Website $website
     */
    public function removeWebsite($website)
    {
        $this->websites->removeElement($website);
        $website->removeWebsiteFeature($this);
    }
}
