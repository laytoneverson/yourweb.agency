<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homePage(Request $request)
    {
        return $this->render('digital-cash/home.html.twig');
    }
}
