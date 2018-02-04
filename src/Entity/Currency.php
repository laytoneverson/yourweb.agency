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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $twitter = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $twitterWidgetId = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $projectWebsiteUrl = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $redditPage = "";



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
     * @return mixed
     */
    public function getCurrencyType()
    {
        return $this->currencyType;
    }

    /**
     * @param mixed $currencyType
     * @return Currency
     */
    public function setCurrencyType($currencyType)
    {
        $this->currencyType = $currencyType;

        return $this;
    }

    /**
     * @return CurrencySnapshot[]
     */
    public function getSnapshots(): array
    {
        return $this->snapshots;
    }

    /**
     * @param CurrencySnapshot[] $snapshots
     * @return Currency
     */
    public function setSnapshots(array $snapshots): Currency
    {
        $this->snapshots = $snapshots;

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
     * @return HashingAlgorithm
     */
    public function getWebsitesSupportingMe(): HashingAlgorithm
    {
        return $this->websitesSupportingMe;
    }

    /**
     * @param HashingAlgorithm $websitesSupportingMe
     * @return Currency
     */
    public function setWebsitesSupportingMe(HashingAlgorithm $websitesSupportingMe): Currency
    {
        $this->websitesSupportingMe = $websitesSupportingMe;

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
    public function getCurrencyName(): string
    {
        return $this->currencyName;
    }

    /**
     * @param string $currencyName
     * @return Currency
     */
    public function setCurrencyName(string $currencyName): Currency
    {
        $this->currencyName = $currencyName;

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
     * @return string
     */
    public function getTwitter(): string
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     * @return Currency
     */
    public function setTwitter(string $twitter): Currency
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * @return string
     */
    public function getTwitterWidgetId(): string
    {
        return $this->twitterWidgetId;
    }

    /**
     * @param string $twitterWidgetId
     * @return Currency
     */
    public function setTwitterWidgetId(string $twitterWidgetId): Currency
    {
        $this->twitterWidgetId = $twitterWidgetId;

        return $this;
    }

    /**
     * @return string
     */
    public function getProjectWebsiteUrl(): string
    {
        return $this->projectWebsiteUrl;
    }

    /**
     * @param string $projectWebsiteUrl
     * @return Currency
     */
    public function setProjectWebsiteUrl(string $projectWebsiteUrl): Currency
    {
        $this->projectWebsiteUrl = $projectWebsiteUrl;

        return $this;
    }

    /**
     * @param CurrencySnapshot $snapshot
     */
    public function addSnapshot(CurrencySnapshot $snapshot)
    {
        $this->snapshots[] = $snapshot;
    }

    /**
     * @param CurrencySnapshot $snapshot
     */
    public function removeSnapshot(CurrencySnapshot $snapshot)
    {
        if (false !== $key = array_search($snapshot, $this->snapshots, true)) {
            array_splice($this->snapshots, $key, 1);
        }
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
}
