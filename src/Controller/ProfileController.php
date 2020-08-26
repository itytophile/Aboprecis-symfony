<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'subs' => $user->getSubs(),
        ]);
    }
}
