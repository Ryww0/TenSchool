<?php

namespace App\Controller\api\Back;

use App\Entity\Question;
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

        dump($rqData);
        dump($data);
//        dump(json_decode('[{"title":"tert","duration":"2323"},{"0":"ffff","1":"erte","2":"terte"}]'));

        // process form data and init Test
        $test = new Test();
        $test
            ->setUser($this->getUser())
            ->setTitle($data[0]["title"])
//            ->setTitle($data['title'])
            ->setAvailable(false)
            ->setDuration($data[0]['duration']);

        // Save Test in DB
        $em = $doctrine->getManager();
        $em->persist($test);
        $em->flush();

        foreach ($data[1] as $question) {
            // Create and init new Question
            $q = new Question();
            $q->setContent($question);

            // Link between Test and Question
            $q->setTest($test);

            // Push Question in the DB
            $em = $doctrine->getManager();
            $em->persist($q);
            $em->flush();
        }

        return new JsonResponse([
            'message' => $data
        ], 200);
    }
}