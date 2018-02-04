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
        return $this->render('service-directory/index.html.twig', [
            'category' => $siteService->getReviewSitesCategory($slug)
        ]);
    }
}
