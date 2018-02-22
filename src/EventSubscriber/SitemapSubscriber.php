<?php

namespace App\EventSubscriber;

use App\Entity\Website;
use App\Entity\WebsiteCategory;
use App\Service\CryptoCurrencySiteService;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Entity\Category;
use http\Url;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url as Sitemap;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapSubscriber implements EventSubscriberInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @var CryptoCurrencySiteService
     */
    private $reviewSiteService;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param ManagerRegistry       $doctrine
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        ManagerRegistry $doctrine,
        CryptoCurrencySiteService $reviewSiteService
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->doctrine = $doctrine;
        $this->reviewSiteService = $reviewSiteService;
    }
    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'populate',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populate(SitemapPopulateEvent $event): void
    {
        $this->registerServiceDirectoryUrls($event->getUrlContainer());
    }

    private function registerServiceDirectoryUrls(UrlContainerInterface $urlContainer)
    {
        /** @var Collection $categories[] */
        $categories = $this->reviewSiteService->getReviewSiteCategories();
        /** @var WebsiteCategory $cat */
        foreach($categories as $cat)
        {
            $sectionPath = $this->urlGenerator->generate(
                'websiteReviewCategory',
                ['slug' => $cat->getCategorySlug()],
                UrlGeneratorInterface::ABSOLUTE_URL
            );
            $sectionUrl = new UrlConcrete($sectionPath, new \DateTime('now'), 'daily', 1);
            $urlContainer->addUrl($sectionUrl, 'Cryptocurrency Services');

            $categorySites = $this->doctrine
                ->getRepository('App:Website')
                ->findSitesInCategoryBySlug($cat->getCategorySlug());

            /** @var Website $site */
            foreach($categorySites as $website){
                $slug = $website->getSlug();
                if ($slug) {
                    $slugPath = $this->urlGenerator->generate(
                        'websiteReview',
                        ['id' => $website->getSlug()],
                        UrlGeneratorInterface::ABSOLUTE_PATH
                    );
                    $urlBySlug = new UrlConcrete($slugPath, null, null, .7);
                    $urlContainer->addUrl($urlBySlug, $cat->getCategorySlug()."-sites");
                } else {
                    $idPath = $this->urlGenerator->generate(
                        'websiteReview',
                        ['id' => $website->getId()],
                        UrlGeneratorInterface::ABSOLUTE_PATH
                    );
                    $urlById = new UrlConcrete($idPath, new \DateTime('now'), null, '.7');
                    $urlContainer->addUrl($urlById, $cat->getCategorySlug() . "-sites");
                }
            }
        }
    }
}
