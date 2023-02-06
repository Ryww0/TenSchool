<?php

namespace App\Controller\api;

use App\Entity\Render;
use App\Entity\Test;
use App\Entity\User;
use App\Repository\TestRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TestController extends AbstractController
{
    #[Route('/api/tests/{user}', name: 'app_api_tests_user')]
    public function index(User $user, SerializerInterface $serializer, TestRepository $repository): JsonResponse
    {
        $tests = $repository->findAllByClassroom($user->getClassroom());
//        $tests = $repository->findAll();
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

    #[Route('/api/test/{test}', name: 'app_api_test_id')]
    public function showTest(Test $test, SerializerInterface $serializer, TestRepository $repository): JsonResponse
    {
        $data = $repository->find($test);

        $jsonContent = $serializer->serialize($data, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            },
            'ignore_null' => true]);

        $response = new JsonResponse($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    #[Route('/api/test/{test}/render/new', methods: ['GET', 'POST'])]
    public function submitRender(Request $request, Test $test, ManagerRegistry $doctrine)
    {
        // get data from the form
        $data = $request->getContent();

        // process form data and init render
        $render = new Render();
        $render->setContent($data);
        $render->setTest($test);
        $render->setUser($this->getUser());

        // Save render in DB
        $em = $doctrine->getManager();
        $em->persist($render);
        $em->flush();

        return new JsonResponse([
            'message' => $data
        ], 200);
    }
}
