<?php

namespace App\Entity;

use App;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use function parse_url;
use const PHP_URL_HOST;
use const PHP_URL_PATH;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteRepository")
 */
class Website
{
    use TimeStampableTrait;

    public const CLIP_BASE_URL = '/website-captures/';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Website Category
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\WebsiteCategory", inversedBy="websites")
     * @var Collection
     */
    private $websiteCategories;

    /**
     * @DoctrineAssert\Enum(entity="App\DBAL\Types\ReviewSiteStatusType")
     * @ORM\Column(type="ReviewSiteStatusType", nullable=true)
     * @var string
     */
    private $websiteStatus;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WebsiteSnapshot", inversedBy="website", cascade={"persist"}, fetch="EAGER")
     * @var WebsiteSnapshot
     */
    private $snapshot;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="website")
     * @var Collection
     */
    private $websiteRatings;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\WebsiteFeature", mappedBy="websites")
     * @var Collection
     */
    private $websiteFeatures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WebsiteInvestmentTerm", mappedBy="website")
     * @var Collection
     */
    private $investmentTerms;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $websiteName = '';

    /**
    * @ORM\Column(type="string", length=255)
    * @var string
    */
    private $websiteUrl = '';

    /**
    * @ORM\Column(type="string", length=255)
    * @var string
    */
    private $websiteImageUrl = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $websiteSummary;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $websiteReview;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $myRecommendation = 5;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $averageRating = 2.5;

    /**
     *
     * @var 
     */
    private $currenciesAccepted;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $featured = false;

    /**
     * @Gedmo\Slug(fields={"websiteName"}, updatable=false )
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     * @var string
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\OutboundLinkUrl", mappedBy="website")
     * @var OutboundLinkUrl
     */
    private $outboundLinkUrl;

    public function getWebsiteFriendlyUrl($scheme = "http://"): string
    {
        $url = $this->getWebsiteUrl();
        $host = parse_url($url, PHP_URL_HOST);
        $path = parse_url($url, PHP_URL_PATH);

        return "{$scheme}{$host}/{$path}";
    }

    public function __toString()
    {
        return $this->getWebsiteName();
    }

    public function __construct()
    {
        $this->websiteRatings = new ArrayCollection();
        $this->websiteCategories = new ArrayCollection();
        $this->currenciesAccepted = new ArrayCollection();
        $this->websiteFeatures = new ArrayCollection();
        $this->investmentTerms = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getWebsiteImageUrl()
    {
        if ($this->getSnapshot()){

            if ($this->getSnapshot()->getFullSizeImageAsset()) {
                return $this->getSnapshot()->getFullSizeImageAsset()->getPublicUrl();
            }
            if ($this->getSnapshot()->getThumbnailImageAsset()) {
                return $this->getSnapshot()->getThumbnailImageAsset()->getPublicUrl();
            }
        }

        return 'http://cryptocurrency-db.oss-us-east-1.aliyuncs.com/LogoSquare.png';
    }

    public function getWebsiteThumbnailUrl()
    {
        if ($this->getSnapshot()){

            if ($this->getSnapshot()->getThumbnailImageAsset()) {
                return $this->getSnapshot()->getThumbnailImageAsset()->getPublicUrl();
            }

            if ($this->getSnapshot()->getFullSizeImageAsset()) {
                return $this->getSnapshot()->getFullSizeImageAsset()->getPublicUrl();
            }
        }

        return 'http://cryptocurrency-db.oss-us-east-1.aliyuncs.com/LogoSquare.png';
    }

    /**
     * @param mixed $id
     * @return Website
     */
    public function setId($id): Website
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getWebsiteCategories(): Collection
    {
        return $this->websiteCategories;
    }

    /**
     * @param Collection $websiteCategories
     * @return Website
     */
    public function setWebsiteCategories(Collection $websiteCategories): Website
    {
        $this->websiteCategories = $websiteCategories;

        return $this;
    }

    /**
     * @return int
     */
    public function getWebsiteStatus(): ?int
    {
        return $this->websiteStatus;
    }

    /**
     * @param int $websiteStatus
     * @return Website
     */
    public function setWebsiteStatus(int $websiteStatus): Website
    {
        $this->websiteStatus = $websiteStatus;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getWebsiteRatings(): Collection
    {
        return $this->websiteRatings;
    }

    /**
     * @param Collection $websiteRatings
     * @return Website
     */
    public function setWebsiteRatings(Collection $websiteRatings): Website
    {
        $this->websiteRatings = $websiteRatings;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteName(): string
    {
        return $this->websiteName;
    }

    /**
     * @param string $websiteName
     * @return Website
     */
    public function setWebsiteName(string $websiteName): Website
    {
        $this->websiteName = $websiteName;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteUrl(): string
    {
        return $this->websiteUrl;
    }

    /**
     * @param string $websiteUrl
     * @return Website
     */
    public function setWebsiteUrl(string $websiteUrl): Website
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * @param string $websiteImageUrl
     * @return Website
     */
    public function setWebsiteImageUrl(string $websiteImageUrl): Website
    {
        $this->websiteImageUrl = $websiteImageUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteSummary(): ?string
    {
        return $this->websiteSummary;
    }

    /**
     * @param string $websiteSummary
     * @return Website
     */
    public function setWebsiteSummary(string $websiteSummary): Website
    {
        $this->websiteSummary = $websiteSummary;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteReview(): ?string
    {
        return $this->websiteReview;
    }

    /**
     * @param string $websiteReview
     * @return Website
     */
    public function setWebsiteReview(string $websiteReview): Website
    {
        $this->websiteReview = $websiteReview;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAverageRating()
    {
        return $this->averageRating;
    }

    /**
     * @param mixed $averageRating
     * @return Website
     */
    public function setAverageRating($averageRating): Website
    {
        $this->averageRating = $averageRating;

        return $this;
    }

    /**
     * @return int
     */
    public function getMyRecommendation(): ?int
    {
        return $this->myRecommendation;
    }

    /**
     * @param int $myRecommendation
     * @return Website
     */
    public function setMyRecommendation(int $myRecommendation): Website
    {
        $this->myRecommendation = $myRecommendation;

        return $this;
    }

    /**
     * @param mixed $websiteCategory
     * @return Website
     */
    public function addWebsiteCategory($websiteCategory): Website
    {
        $this->websiteCategories->add($websiteCategory);
        // uncomment if you want to update other side
        $websiteCategory->setWebsite($this);

        return $this;
    }

    /**
     * @param mixed $websiteCategory
     * @return Website
     */
    public function removeWebsiteCategory($websiteCategory): ?Website
    {
        $this->websiteCategories->removeElement($websiteCategory);
        $websiteCategory->setWebsite(null);

        return $this;
    }

    /**
     * @param mixed $websiteRating
     * @return Website
     */
    public function addWebsiteRating($websiteRating): Website
    {
        $this->websiteRatings->add($websiteRating);
        $websiteRating->setWebsite($this);

        return $this;
    }

    /**
     * @param mixed $websiteRating
     +*/
    public function removeWebsiteRating($websiteRating): void
    {
        $this->websiteRatings->removeElement($websiteRating);
        $websiteRating->setWebsite(null);
    }

    /**
     * @return mixed
     */
    public function getCurrenciesAccepted()
    {
        return $this->currenciesAccepted;
    }

    /**
     * @param mixed $currenciesAccepted
     * @return Website
     */
    public function setCurrenciesAccepted($currenciesAccepted): Website
    {
        $this->currenciesAccepted = $currenciesAccepted;

        return $this;
      }

    /**
     * @return bool
     */
    public function isFeatured(): bool
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured(bool $featured): void
    {
        $this->featured = $featured;
    }

    /**
     * @return Collection
     */
    public function getWebsiteFeatures(): Collection
    {
        return $this->websiteFeatures;
    }

    /**
     * @param Collection $websiteFeatures
     * @return Website
     */
    public function setWebsiteFeatures(Collection $websiteFeatures): Website
    {
        $this->websiteFeatures = $websiteFeatures;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getInvestmentTerms(): Collection
    {
        return $this->investmentTerms;
    }

    /**
     * @param Collection $investmentTerms
     * @return Website
     */
    public function setInvestmentTerms(Collection $investmentTerms): Website
    {
        $this->investmentTerms = $investmentTerms;

        return $this;
    }

    /**
     * @param mixed $websiteFeature
     */
    public function addWebsiteFeature($websiteFeature)
    {
        $this->websiteFeatures->add($websiteFeature);
        $websiteFeature->setWebsite($this);
    }

    /**
     * @param mixed $websiteFeature
     */
    public function removeWebsiteFeature($websiteFeature)
    {
        $this->websiteFeatures->removeElement($websiteFeature);
        $websiteFeature->setWebsite(null);
    }

    /**
     * @param mixed $investmentTerm
     */
    public function addInvestmentTerm(WebsiteInvestmentTerm $investmentTerm)
    {
        $this->investmentTerms->add($investmentTerm);
        $investmentTerm->setWebsite($this);
    }

    /**
     * @param mixed $investmentTerm
     */
    public function removeInvestmentTerm(WebsiteInvestmentTerm $investmentTerm)
    {
        $this->investmentTerms->removeElement($investmentTerm);
        $investmentTerm->setWebsite(null);
    }

    /**
     * @return WebsiteSnapshot
     */
    public function getSnapshot(): ?WebsiteSnapshot
    {
        return $this->snapshot;
    }

    /**
     * @param WebsiteSnapshot $snapshot
     * @return Website
     */
    public function setSnapshot(WebsiteSnapshot $snapshot): Website
    {
        $this->snapshot = $snapshot;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Website
     */
    public function setSlug(string $slug = null): Website
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return OutboundLinkUrl
     */
    public function getOutboundLinkUrl(): OutboundLinkUrl
    {
        return $this->outboundLinkUrl;
    }

    /**
     * @param OutboundLinkUrl $outboundLinkUrl
     */
    public function setOutboundLinkUrl(OutboundLinkUrl $outboundLinkUrl): void
    {
        $this->outboundLinkUrl = $outboundLinkUrl;
    }


}
