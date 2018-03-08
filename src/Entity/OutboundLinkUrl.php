<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;
use function parse_url;
use const PHP_URL_HOST;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OutboundLinkUrlRepository")
 */
class OutboundLinkUrl
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OutboundLinkClick", mappedBy="outboundLinkUrl")
     * @var Collection
     */
    private $outboundLinkClicks;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Website", inversedBy="outboundLinkUrl")
     * @var Website
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $linkUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $host;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $lastVisit;

    /**
     * @ORM\Column(type="string", length=255)
     * @var int
     */
    private $totalVisits = 0;

    /**
     * OutboundLinkUrl constructor, send a url or a Website entity
     *
     * @param mixed $link
     */
    public function __construct($link)
    {
        if ($link instanceof Website) {
            $this->website = $link;
            $linkUrl = $link->getWebsiteUrl();
        } else {
            $linkUrl = $link;
        }

        $this->host = parse_url($linkUrl, PHP_URL_HOST);
        $this->linkUrl = $linkUrl;
        $this->lastVisit = new DateTime();
        $this->outboundLinkClicks = new ArrayCollection();
    }

    public function visit()
    {
        $this->lastVisit = new DateTime();
        $this->totalVisits++;
    }

    /**
     * @param string $linkUrl
     * @return OutboundLinkUrl
     */
    public function setLinkUrl(string $linkUrl): OutboundLinkUrl
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }

    /**
     * @param int $totalVisits
     * @return OutboundLinkUrl
     */
    public function setTotalVisits(int $totalVisits): OutboundLinkUrl
    {
        $this->totalVisits = $totalVisits;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLinkUrl(): string
    {
        return $this->linkUrl;
    }

    /**
     * @return Collection
     */
    public function getOutboundLinkClicks(): Collection
    {
        return $this->outboundLinkClicks;
    }

    /**
     * @return Website
     */
    public function getWebsite(): Website
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return DateTime
     */
    public function getLastVisit(): DateTime
    {
        return $this->lastVisit;
    }

    /**
     * @return int
     */
    public function getTotalVisits(): int
    {
        return $this->totalVisits;
    }
}
