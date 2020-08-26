<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MysubsController extends AbstractController
{
    /**
     * @Route("/mysubs", name="mysubs")
     */
    public function index()
    {
        return $this->render('mysubs/index.html.twig', [
            'controller_name' => 'MysubsController',
        ]);
    }
}
