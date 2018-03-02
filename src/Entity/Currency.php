<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use App\DBAL\Types\CurrencyType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
 */
class Currency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\CurrencyType")
     * @ORM\Column(type="CurrencyType", nullable=true)
     * @var Website
     */
    private $currencyType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CurrencyProofOfWork", inversedBy="currencies")
     * @var CurrencyProofOfWork[];
     */
    private $proofOfWorkTypes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HashingAlgorithm", mappedBy="myCurrency")
     * @var HashingAlgorithm
     */
    private $hashingAlgorithm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CurrencySnapshot", mappedBy="currency")
     * @var CurrencySnapshot[]
     */
    private $marketSnapshots;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Website", mappedBy="currencies")
     * @var HashingAlgorithm
     */
    private $websites;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $currencyRank = 0;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     */
    private $currencyCode = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     */
    private $currencyDisplayName = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageUrl = "";

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $description = "";

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $features = "";

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     * @var string
     */
    private $technology = "";

    /**
     * @ORM\Column(type="datetime_immutable")
     * @var \DateTime
     */
    private $launchDate = "";


    public function __construct()
    {
        $this->snapshots = new ArrayCollection();
        $this->websitesSupportingMe = new ArrayCollection();
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
     * @return Currency
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Website
     */
    public function getCurrencyType(): Website
    {
        return $this->currencyType;
    }

    /**
     * @param Website $currencyType
     * @return Currency
     */
    public function setCurrencyType(Website $currencyType): Currency
    {
        $this->currencyType = $currencyType;

        return $this;
    }

    /**
     * @return CurrencyProofOfWork[]
     */
    public function getProofOfWorkTypes(): array
    {
        return $this->proofOfWorkTypes;
    }

    /**
     * @param CurrencyProofOfWork[] $proofOfWorkTypes
     * @return Currency
     */
    public function setProofOfWorkTypes(array $proofOfWorkTypes): Currency
    {
        $this->proofOfWorkTypes = $proofOfWorkTypes;

        return $this;
    }

    /**
     * @return HashingAlgorithm
     */
    public function getHashingAlgorithm(): HashingAlgorithm
    {
        return $this->hashingAlgorithm;
    }

    /**
     * @param HashingAlgorithm $hashingAlgorithm
     * @return Currency
     */
    public function setHashingAlgorithm(HashingAlgorithm $hashingAlgorithm): Currency
    {
        $this->hashingAlgorithm = $hashingAlgorithm;

        return $this;
    }

    /**
     * @return CurrencySnapshot[]
     */
    public function getMarketSnapshots(): array
    {
        return $this->marketSnapshots;
    }

    /**
     * @param CurrencySnapshot[] $marketSnapshots
     * @return Currency
     */
    public function setMarketSnapshots(array $marketSnapshots): Currency
    {
        $this->marketSnapshots = $marketSnapshots;

        return $this;
    }

    /**
     * @return HashingAlgorithm
     */
    public function getWebsites(): HashingAlgorithm
    {
        return $this->websites;
    }

    /**
     * @param HashingAlgorithm $websites
     * @return Currency
     */
    public function setWebsites(HashingAlgorithm $websites): Currency
    {
        $this->websites = $websites;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrencyRank(): int
    {
        return $this->currencyRank;
    }

    /**
     * @param int $currencyRank
     * @return Currency
     */
    public function setCurrencyRank(int $currencyRank): Currency
    {
        $this->currencyRank = $currencyRank;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return Currency
     */
    public function setCurrencyCode(string $currencyCode): Currency
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyDisplayName(): string
    {
        return $this->currencyDisplayName;
    }

    /**
     * @param string $currencyDisplayName
     * @return Currency
     */
    public function setCurrencyDisplayName(string $currencyDisplayName): Currency
    {
        $this->currencyDisplayName = $currencyDisplayName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return Currency
     */
    public function setImageUrl(string $imageUrl): Currency
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Currency
     */
    public function setDescription(string $description): Currency
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeatures(): string
    {
        return $this->features;
    }

    /**
     * @param string $features
     * @return Currency
     */
    public function setFeatures(string $features): Currency
    {
        $this->features = $features;

        return $this;
    }

    /**
     * @return string
     */
    public function getTechnology(): string
    {
        return $this->technology;
    }

    /**
     * @param string $technology
     * @return Currency
     */
    public function setTechnology(string $technology): Currency
    {
        $this->technology = $technology;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLaunchDate(): \DateTime
    {
        return $this->launchDate;
    }

    /**
     * @param \DateTime $launchDate
     * @return Currency
     */
    public function setLaunchDate(\DateTime $launchDate): Currency
    {
        $this->launchDate = $launchDate;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSnapshots(): ArrayCollection
    {
        return $this->snapshots;
    }

    /**
     * @param ArrayCollection $snapshots
     */
    public function setSnapshots(ArrayCollection $snapshots): void
    {
        $this->snapshots = $snapshots;
    }

    /**
     * @return ArrayCollection
     */
    public function getWebsitesSupportingMe(): ArrayCollection
    {
        return $this->websitesSupportingMe;
    }

    /**
     * @param ArrayCollection $websitesSupportingMe
     */
    public function setWebsitesSupportingMe(ArrayCollection $websitesSupportingMe): void
    {
        $this->websitesSupportingMe = $websitesSupportingMe;
    }

    /**
     * @param CurrencyProofOfWork $proofOfWorkType
     */
    public function addProofOfWorkType(CurrencyProofOfWork $proofOfWorkType)
    {
        $this->proofOfWorkTypes[] = $proofOfWorkType;
    }

    /**
     * @param CurrencyProofOfWork $proofOfWorkType
     */
    public function removeProofOfWorkType(CurrencyProofOfWork $proofOfWorkType)
    {
        if (false !== $key = array_search($proofOfWorkType, $this->proofOfWorkTypes, true)) {
            array_splice($this->proofOfWorkTypes, $key, 1);
        }
    }

    /**
     * @param CurrencySnapshot $marketSnapshot
     */
    public function addMarketSnapshot(CurrencySnapshot $marketSnapshot)
    {
        $this->marketSnapshots[] = $marketSnapshot;
    }

    /**
     * @param CurrencySnapshot $marketSnapshot
     */
    public function removeMarketSnapshot(CurrencySnapshot $marketSnapshot)
    {
        if (false !== $key = array_search($marketSnapshot, $this->marketSnapshots, true)) {
            array_splice($this->marketSnapshots, $key, 1);
        }
    }
}
