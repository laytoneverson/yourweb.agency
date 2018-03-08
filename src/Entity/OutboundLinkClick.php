<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OutboundLinkClickRepository")
 */
class OutboundLinkClick
{
    use TimeStampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $visitorIp;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $fromPage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OutboundLinkUrl", inversedBy="outboundLinkClicks")
     * @var OutboundLinkUrl
     */
    private $outboundLinkUrl;

    public function __construct(OutboundLinkUrl $outboundLink, $visitorIp, $from)
    {
        $this->outboundLinkUrl = $outboundLink;
        $this->fromPage = $from;
        $this->visitorIp = $visitorIp;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getVisitorIp()
    {
        return $this->visitorIp;
    }

    /**
     * @return string
     */
    public function getFromPage(): string
    {
        return $this->fromPage;
    }

    /**
     * @return OutboundLinkUrl
     */
    public function getOutboundLinkUrl(): OutboundLinkUrl
    {
        return $this->outboundLinkUrl;
    }
}
