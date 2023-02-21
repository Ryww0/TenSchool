<?php

namespace App\Controller\api\Back;

use App\Entity\Test;
use App\Repository\ClassroomRepository;
use App\Repository\QuestionRepository;
use App\Repository\TestRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/api/back/test/new', methods: ['POST'])]
    public function submitNewTest(Request $request, ManagerRegistry $doctrine, QuestionRepository $questionRepository)
    {
        // get data from the form
        $rqData = $request->getContent();
        $data = json_decode($rqData, true);

        // process form data and init Test
        $test = new Test();
        $test
            ->setUser($this->getUser())
            ->setTitle($data[0]['title'])
            ->setAvailable(false)
            ->setDuration($data[0]['duration'])
        ;

        foreach ($data[1] as $question) {
            $test->addQuestion($questionRepository->find($question));
        }


        // Save Test in DB
        $em = $doctrine->getManager();
        $em->persist($test);
        $em->flush();

        return new JsonResponse([
            'message' => $data
        ], 200);
    }
}