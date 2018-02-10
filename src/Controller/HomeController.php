<?php

namespace App\Controller;

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
     * @Route("/", name="home")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homePageAction(Request $request)
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/coming-soon", name="coming-soon")
     */
    public function comingSoonAction()
    {
        return $this->render('home/coming-soon.html.twig');
    }
}
