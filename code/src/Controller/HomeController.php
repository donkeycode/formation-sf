<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Cms\Manager;


class HomeController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="home")
     */
    public function index(Manager $cmsManager)
    {
        dump($cmsManager->render('pub'));
        dump($cmsManager->render('article'));

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/hay/{name}", requirements={ "name": "\w+"}, methods={"GET"}, name="hello")
     */
    public function hello($name = "remy")
    {
        return $this->render('home/hello.html.twig', [
            'name' => $name,
        ]);
    }

}
