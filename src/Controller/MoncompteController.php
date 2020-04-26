<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MoncompteController extends AbstractController
{
    /**
     * @Route("/moncompte", name="moncompte")
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


        
        }

        return $this->render('moncompte/index.html.twig', [
            'User' => $user,
            'form' => $form->createView()
        ]);
    }
}
