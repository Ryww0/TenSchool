<?php

namespace App\Controller\api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CheckAdminController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/api/check-admin', name: 'app_check-admin')]
    public function __invoke(): JsonResponse
    {
        $isAdmin = $this->security->isGranted('ROLE_ADMIN');

        $response = new JsonResponse(['isAdmin' => $isAdmin]);

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}