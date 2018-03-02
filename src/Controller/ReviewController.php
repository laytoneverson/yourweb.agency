<?php

namespace App\Controller;

use App\Service\CryptoCurrencySiteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ReviewController
 * @package App\Controller\CryptoCurrency
 */
class ReviewController extends AbstractController
{
    /**
     * @Route("/cryptocoin-service-directory/{slug}", name="websiteReviewCategory")
     * @param CryptoCurrencySiteService $siteService
     * @param $slug
     * @param $siteStatus
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewCategoryAction(CryptoCurrencySiteService $siteService, $slug, $siteStatus = null)
    {
        $category = $siteService->getReviewSitesCategory($slug, $siteStatus);

        return $this->render('service-directory/index.html.twig', [
            'category' => $category,
            'categories' => $siteService->getReviewSiteCategories(),
            'featuredSites' => $siteService->getFeaturedSites(6),
        ]);
    }

    /**
     * @Route("/cryptocoin-service-directory/{categorySlug}/{siteSlug}", name="categoryWebsiteReview")
     * @param CryptoCurrencySiteService $siteService
     * @param $categorySlug
     * @param $siteSlug
     */
    public function categoryServiceReview(
        CryptoCurrencySiteService $siteService,$categorySlug, $siteSlug
    ) {
        return $this->serviceReviewAction($siteService, $siteSlug);
    }

    /**
     * @Route("/cryptocoin-service-directory/website_review/{slug}", name="websiteReview")
     * @param CryptoCurrencySiteService $siteService
     * @param $slug
     * @param $siteStatus
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function serviceReviewAction(CryptoCurrencySiteService $siteService, $slug)
    {
        return $this->render('service-directory/view-item.html.twig', [
            'site' => $siteService->getReviewSite($slug),
        ]);
    }
}
