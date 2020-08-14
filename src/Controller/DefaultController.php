<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_enter")
     */
    public function homepage ()
    {
        return $this->render('enter.html.twig');
    }

    /**
     * @Route("/table", name="app_homepage")
     */

    public function show() {
        return new Response();
    }

}