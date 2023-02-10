<?php

namespace App\Controller\api;

use App\Entity\Subject;
use App\Repository\LessonRepository;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SubjectController extends AbstractController
{
    #[Route('/api/subjects', name: 'app_api_subjects')]
    public function allSubjects(SerializerInterface $serializer, SubjectRepository $repository)
    {
        if ($this->getUser()) {
            $subjects = $repository->findAllSubjectWhereUserConnectedClassroomIdIsEqualToClassroomId($this->getUser()->getClassroom());
            dump($this->getUser());
        } else {
            $subjects = null;
        }

        $jsonContent = $serializer->serialize($subjects, 'json', [
            'groups' => ['subject']
        ]);

        $response = new JsonResponse($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    #[Route('api/subject/{subject}/lessons', name: 'app_api_subject_id')]
    public function getLessonsFromTheSubject(Subject $subject, LessonRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $data = $repository->findAllLessonsBySubject($subject);

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