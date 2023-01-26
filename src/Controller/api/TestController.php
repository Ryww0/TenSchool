<?php

namespace App\Controller\api;

use App\Entity\User;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TestController extends AbstractController
{
    #[Route('/api/tests/{user}', name: 'app_api_tests_user')]
    public function index(User $user, SerializerInterface $serializer, TestRepository $repository): JsonResponse
    {
        $tests = $repository->findAllByUser($user);
        dump($tests);
        $jsonContent = $serializer->serialize($tests, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            },
            'ignore_null' => true]);

        $response = new JsonResponse($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

}
