<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteInvestmentTermRepository")
 */
class WebsiteInvestmentTerm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Website", inversedBy="investmentTerms")
     * @var Website
     */
    private $website;

    /**
     * @ORM\Column(type="decimal")
     * @var float
     */
    private $from;

    /**
     * @ORM\Column(type="decimal")
     * @var float
     */
    private $to;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $payout;

    /**
     * @var string
     */
    private $recurSpec;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return WebsiteInvestmentTerm
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Website
     */
    public function getWebsite(): Website
    {
        return $this->website;
    }

    /**
     * @param Website $website
     * @return WebsiteInvestmentTerm
     */
    public function setWebsite(Website $website): WebsiteInvestmentTerm
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return float
     */
    public function getFrom(): float
    {
        return $this->from;
    }

    /**
     * @param float $from
     * @return WebsiteInvestmentTerm
     */
    public function setFrom(float $from): WebsiteInvestmentTerm
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return float
     */
    public function getTo(): float
    {
        return $this->to;
    }

    /**
     * @param float $to
     * @return WebsiteInvestmentTerm
     */
    public function setTo(float $to): WebsiteInvestmentTerm
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayout(): string
    {
        return $this->payout;
    }

    /**
     * @param string $payout
     * @return WebsiteInvestmentTerm
     */
    public function setPayout(string $payout): WebsiteInvestmentTerm
    {
        $this->payout = $payout;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecurSpec(): string
    {
        return $this->recurSpec;
    }

    /**
     * @param string $recurSpec
     * @return WebsiteInvestmentTerm
     */
    public function setRecurSpec(string $recurSpec): WebsiteInvestmentTerm
    {
        $this->recurSpec = $recurSpec;

        return $this;
    }
}
