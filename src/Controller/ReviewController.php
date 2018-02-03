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
     * @Route("/website-reviews-for/{slug}", name="websiteReviewCategory")
     * @param CryptoCurrencySiteService $siteService
     * @param $slug
     */
    public function viewCategoryAction(CryptoCurrencySiteService $siteService, $slug)
    {
        return $this->render('review-sites-list.html.twig', [
            'sites' => $siteService->getReviewSitesInCategory($slug)
        ]);
    }
}
