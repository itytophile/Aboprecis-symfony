<?php

namespace App\Controller;

use App\Service\YoutubeApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class MysubsController extends AbstractController
{
    /**
     * @Route("/mysubs", name="mysubs")
     */
    public function index(YoutubeApi $api)
    {
        $user = $this->getUser();

        $subs = $user->getSubs();

        $arrayOfResults = [];

        foreach($subs as $sub) {
            $arrayOfResults[] = $api->getVideosBySub($sub, 3);
        }

        return $this->render('mysubs/index.html.twig', [
            'arrayOfResults' => $arrayOfResults,
        ]);
    }
}
