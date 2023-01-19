<?php

namespace App\Controller\api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CheckLoginController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/api/check-login', name: 'app_check-login', methods: 'GET')]
    public function __invoke(): JsonResponse
    {
        $isLoggedIn = $this->security->isGranted('IS_AUTHENTICATED_FULLY');

        $response =  new JsonResponse(['isLoggedIn' => $isLoggedIn]);

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}