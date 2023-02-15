<?php

namespace App\Controller\api\Back;

use App\Repository\TestRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TestController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/api/back/tests')]
    public function index(TestRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $tests = $repository->findAll();

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