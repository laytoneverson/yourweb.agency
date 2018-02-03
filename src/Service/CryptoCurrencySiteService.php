<?php

namespace App\Service;

use App\Entity\Website;
use App\Entity\WebsiteCategory;
use App\Repository\WebsiteCategoryRepository;
use App\Repository\WebsiteRepository;
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

    public function getReviewSitesInCategory(string $categorySlug)
    {
        return $this->websiteRepository->findSitesInCategoryBySlug($categorySlug);
    }

    public function getReviewSite(string $siteIdOrSlug)
    {
        if (is_numeric($siteIdOrSlug)){
            //getById
        }
    }
}
