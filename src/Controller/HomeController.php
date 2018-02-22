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
     * @Route("/coming-soon", name="coming-soon", options={
     *     "sitemap" = {"priority" = 0.5, "changefreq" = "never", "section" = "home" }
     *     })
     */
    public function comingSoonAction()
    {
        return $this->render('home/coming-soon.html.twig');
    }
}
