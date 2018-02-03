<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocialSiteRepository")
 */
class SocialSite
{
    public const MAINWEBSITE = 1;
    public const TWITTER = 2;
    public const FACEBOOK = 3;
    public const GITHUB = 4;
    public const LINKEDIN = 5;
    public const REDDIT = 6;
    public const CRYPTO_COMPARE = 7;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SiteSocialLink", mappedBy="socialSite")
     * @var Collection
     */
    private $socialLinks;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $siteName;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $siteIconUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $siteUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $profileUrlStub;

    public function __construct()
    {
        $this->socialLinks = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getSiteName();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return SocialSite
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSocialLinks(): Collection
    {
        return $this->socialLinks;
    }

    /**
     * @param Collection $socialLinks
     * @return SocialSite
     */
    public function setSocialLinks(Collection $socialLinks): SocialSite
    {
        $this->socialLinks = $socialLinks;

        return $this;
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return $this->siteName;
    }

    /**
     * @param string $siteName
     * @return SocialSite
     */
    public function setSiteName(string $siteName): SocialSite
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * @return string
     */
    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    /**
     * @param string $siteUrl
     * @return SocialSite
     */
    public function setSiteUrl(string $siteUrl): SocialSite
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getProfileUrlStub(): string
    {
        return $this->profileUrlStub;
    }

    /**
     * @param string $profileUrlStub
     * @return SocialSite
     */
    public function setProfileUrlStub(string $profileUrlStub): SocialSite
    {
        $this->profileUrlStub = $profileUrlStub;

        return $this;
    }

    /**
     * @param SiteSocialLink $socialLink
     */
    public function addSocialLink(SiteSocialLink $socialLink)
    {
        $this->socialLinks->add($socialLink);

        $socialLink->setSocialSite($this);
    }

    /**
     * @param SiteSocialLink $socialLink
     */
    public function removeSocialLink(SiteSocialLink $socialLink)
    {
        $this->socialLinks->removeElement($socialLink);

        $socialLink->setSocialSite(null);
    }

    /**
     * @return string
     */
    public function getSiteIconUrl(): string
    {
        return $this->siteIconUrl;
    }

    /**
     * @param string $siteIconUrl
     * @return SocialSite
     */
    public function setSiteIconUrl(string $siteIconUrl): SocialSite
    {
        $this->siteIconUrl = $siteIconUrl;

        return $this;
    }
}
