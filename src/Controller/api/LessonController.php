<?php

namespace App\Controller\api;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LessonController extends AbstractController
{
    #[Route('/api/lesson/{lesson}', name: 'app_api_lesson_id')]
    public function showLesson(Lesson $lesson, LessonRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $data = $repository->find($lesson);

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