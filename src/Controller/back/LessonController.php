<?php

namespace App\Controller\back;

use App\Entity\Lesson;
use App\Form\LessonType;
use App\Repository\LessonRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin')]
class LessonController extends AbstractController
{
    #[Route('/lesson', name: 'app_admin_lesson')]
    public function index(Request $request, ManagerRegistry $doctrine, LessonRepository $lessonRepository): Response
    {
        $lessons = $lessonRepository->findAll();


        return $this->render('back/lesson/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }

    #[Route('/lesson/delete/{lesson}', name: 'app_admin_lesson_delete')]
    public function deleteLessonById(Lesson $lesson, LessonRepository $lessonRepository): Response
    {
        $lessonRepository->remove($lesson, true);

        return $this->redirectToRoute('app_admin_lesson', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/lesson/create', name: 'app_admin_lesson_create')]
    public function createNewLesson(Request $request, ManagerRegistry $doctrine): Response
    {
        $lesson = new Lesson();
        $lesson->setDateCreated(new \DateTime('now'));
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lesson = $form->getData();

            $em = $doctrine->getManager();
            $em->persist($lesson);
            $em->flush();

            return $this->redirectToRoute('app_admin_lesson', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('back/lesson/new-lesson.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
