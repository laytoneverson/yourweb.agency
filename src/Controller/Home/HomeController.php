<?php

namespace App\Controller\Home;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(host="yourweb.online")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/home")
     * @Route("/")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homePage(Request $request)
    {
        return $this->render('home/home.html.twig');
    }
}
