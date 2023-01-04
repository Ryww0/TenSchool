<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Repository\SubjectRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectController extends AbstractController {
    #[Route('subjects/{subject}', name: 'app_subjects_subject' , defaults: ['subject' => 1])]
    public function showSubject(Subject $subject, SubjectRepository $subjectRepository): Response
    {
        $user = $this->getUser()->getClassroom();

        $ss = $subjectRepository->findAllSubjectWhereUserConnectedClassroomIdIsEqualToClassroomId($user);
        $s = $subjectRepository->noName($user, $subject->getId());

        dump($s);

        return $this->render('subject/subject.html.twig', [
            'subject' => $s,
            'ss' => $ss
        ]);
    }
}