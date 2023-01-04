<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users/{user}', name: 'app_users_user')]
    public function index(User $user): Response
    {
        dump($this->getUser()->getId());
        dump($user->getId());

        if ($this->getUser()->getId() != $user->getId()) {
            dump('je suis dans le IF');
            return $this->redirectToRoute('app_subjects_subject');
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
