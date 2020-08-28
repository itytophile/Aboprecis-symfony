<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ChannelNameType;
use App\Service\YoutubeApi;
use Google_Client;

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

    /**
     * @Route("/profile/new", name="new")
     */
    public function new()
    {
        $form = $this->createForm(ChannelNameType::class);
        return $this->render('profile/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/profile/new/get", name="getChannel", methods={"POST"})
     */
    public function getChannel(Request $request, YoutubeApi $api)
    {

        $form = $this->createForm(ChannelNameType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $channelName = $data['channel_name'];
            return $this->json([
                'isValid' => true,
                'channels' => $api->getChannelsByName($channelName, 3),
            ]);
        }

        return $this->json(['isValid' => false]);
    }
}
