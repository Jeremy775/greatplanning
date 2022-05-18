<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="app_user_form")
     */
    public function edit(User $user, Request $request, UserRepository $userRepository, EntityManagerInterface $manager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('home/index.html.twig');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('planning/index.html.twig');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $userRepository->add($user);

            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'succes',
                'Vos informations ont été prises en compte'
            );

            return $this->redirect('app_user_show');
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'user_form' => $form,
        ]);
    }
}
