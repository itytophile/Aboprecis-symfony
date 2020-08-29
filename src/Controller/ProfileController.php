<?php

namespace App\Controller;

use App\Entity\Sub;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ChannelNameType;
use App\Form\SubType;
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
     * @Route("/profile/new", name="new", methods={"GET"})
     */
    public function new()
    {
        $form = $this->createForm(ChannelNameType::class);
        $formSub = $this->createForm(SubType::class, null, [
            'action' => $this->generateUrl('newPost')
        ]);

        return $this->render('profile/new.html.twig', [
            'form' => $form->createView(),
            'formSub' => $formSub->createView(),
        ]);
    }

    /**
     * @Route("/profile/new", name="newPost", methods={"POST"})
     */
    public function newPost(Request $request)
    {
        $sub = new Sub();

        $form = $this->createForm(SubType::class, $sub);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // You have to add the user manually to the sub instance,
            // the form doesn't handle it
            $sub->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sub);
            $entityManager->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->json([ 'isValid' => false ]);
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

    /**
     * @Route("/profile/delete/{id}", name="delete")
     */
    public function delete($id) {
        $entityManager = $this->getDoctrine()->getManager();

        $subToDelete = $entityManager->getRepository(Sub::class)->find($id);
        $user = $this->getUser();

        // We check if the user is the owner of the sub he wants to delete
        if($subToDelete && $subToDelete->getUser()->getId() == $user->getId()) {
            $entityManager->remove($subToDelete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profile');
    }
}
