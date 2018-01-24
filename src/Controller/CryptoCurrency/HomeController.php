<?php

namespace App\Controller\CryptoCurrency;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", host="%domain_cryptocurrency%")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homePage(Request $request)
    {
        return $this->render('cryptocurrency/home.html.twig');
    }
}
