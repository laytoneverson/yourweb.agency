<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * #Route(host="%domain_cryptocurrency%")
 * @package App\Controller\CryptoCurrency
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home-page")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homePageAction(Request $request)
    {
        return $this->render('home/home.html.twig');
    }
}
