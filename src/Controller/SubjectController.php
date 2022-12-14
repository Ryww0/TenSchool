<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Repository\SubjectRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectController extends AbstractController {
    #[Route('subjects/{subject}', name: 'app_subjects_subject')]
    public function showSubject(Subject $subject, SubjectRepository $subjectRepository): Response
    {
        $ss = $subjectRepository->findAll();
        $s = $subjectRepository->find($subject);

        return $this->render('subject/subject.html.twig', [
            'subject' => $s,
            'subjects' => $ss,
        ]);
    }
}