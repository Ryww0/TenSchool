<?php

namespace App\Controller\api;

use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SubjectController extends AbstractController
{
    #[Route('/api/subjects', name: 'app_api_subjects')]
    public function allSubjects(SerializerInterface $serializer, SubjectRepository $repository): JsonResponse
    {
        $subjects = $repository->findAll();

        $jsonContent = $serializer->serialize($subjects, 'json', [
            'groups' => ['subject']
        ]);

        $response = new JsonResponse($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}