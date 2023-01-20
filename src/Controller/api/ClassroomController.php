<?php

namespace App\Controller\api;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ClassroomController extends AbstractController {
        #[Route('api/classrooms/{classroom}', name: 'app_api_classroom_id')]
    public function findClassroom(Classroom $classroom, ClassroomRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $data = $repository->find($classroom);

        dump($data);

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
}