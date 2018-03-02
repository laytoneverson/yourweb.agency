<?php

namespace App\Service;

use App\Entity\Website;
use App\Entity\WebsiteCategory;
use App\Repository\WebsiteCategoryRepository;
use App\Repository\WebsiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use function is_numeric;

class CryptoCurrencySiteService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var WebsiteRepository
     */
    private $websiteRepository;

    /**
     * @var WebsiteCategoryRepository
     */
    private $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->websiteRepository = $entityManager->getRepository(Website::class);
        $this->categoryRepository = $entityManager->getRepository(WebsiteCategory::class);
        $this->entityManager = $entityManager;
    }

    public function getReviewSitesCategory(string $categorySlug, $status = null)
    {
        return $this->categoryRepository->findCategoryWithSitesBySlug($categorySlug, $status);
    }

    /**
     * @return array
     */
    public function getReviewSiteCategories(): array
    {
        return $this->categoryRepository->findCategoriesAndSites();
    }

    /**
     * @param string $slug
     * @return Website|null
     */
    public function getReviewSite(string $slug): ?Website
    {
        return $this->websiteRepository->findSiteBySlug($slug);
    }

    public function getFeaturedSites($count = 10)
    {
        return $this->websiteRepository->getFeaturedSites($count);
    }
}
