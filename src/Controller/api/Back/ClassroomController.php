<?php

namespace App\Controller\api\Back;

use App\Entity\User;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ClassroomController extends AbstractController
{
    #[Route('/api/back/classrooms/user/{user}')]
    public function allClassroomsCreatedByAdmin(User $user, ClassroomRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $classrooms = $repository->findAllByUser($user);

        $jsonContent = $serializer->serialize($classrooms, 'json', [
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