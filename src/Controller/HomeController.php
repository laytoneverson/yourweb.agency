<?php

namespace App\Controller;

use App\Entity\Website;

use App\Entity\WebsiteCategory;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package App\Controller\CryptoCurrency
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", options={
     *     "sitemap" = {"priority" = 0.5, "changefreq" = "daily", "section" = "home" }
     *     })
     * @param EntityManagerInterface $entityManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homePageAction(EntityManagerInterface $entityManager)
    {
        $newSites = $entityManager
            ->getRepository(Website::class)
            ->getRecentAdditions(8);

        $siteCategories = $entityManager
            ->getRepository(WebsiteCategory::class)
            ->findAll();

        return $this->render('home/home.html.twig', [
            'newSites' => $newSites,
            'categories' => $siteCategories,
        ]);
    }

    /**
     * @Route("/search", name="search", options={
     *     "sitemap" = {"priority" = 0.1, "changefreq" = "yearly", "section" = "home" }
     *     })
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $s = $request->query->get('s');
        return $this->render('home/search.html.twig');
    }



    /**
     * @Route("/legal-stuff/terms-of-use", name="terms-of-use", options={
     *     "sitemap" = {"priority" = 0.1, "changefreq" = "yearly", "section" = "home" }
     *     })
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function termsOfUseAction()
    {
        return $this->render('pages/terms-of-service.html.twig');
    }

    /**
     * @Route("/legal-stuff/privacy-policy", name="privacy-policy", options={
     *     "sitemap" = {"priority" = 0.1, "changefreq" = "yearly", "section" = "home" }
     *     })
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function privacyAction()
    {
        return $this->render('pages/terms-of-service.html.twig');
    }

    /**
     * @Route("/coming-soon", name="coming-soon", options={
     *     "sitemap" = {"priority" = 0.5, "changefreq" = "never", "section" = "home" }
     *     })
     */
    public function comingSoonAction()
    {
        return $this->render('home/coming-soon.html.twig');
    }
}
