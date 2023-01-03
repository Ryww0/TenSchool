<?php

namespace App\Controller\back;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin')]
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_admin_classroom')]
    public function index(Request $request, ManagerRegistry $doctrine, ClassroomRepository $classroomRepository): Response
    {
        $classrooms = $classroomRepository->findAll();

        return $this->render('back/classroom/index.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }

    #[Route('/classroom/create', name: 'app_admin_classroom_create')]
    public function createNewClassroom(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();

        $classroom = new Classroom();
        $classroom->setUser($user);

        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classroom = $form->getData();

            $em = $doctrine->getManager();
            $em->persist($classroom);
            $em->flush();

            return $this->redirectToRoute('app_admin_classroom');
        }

        return $this->render('back/classroom/new-classroom.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/classroom/delete/{classroom}', name: 'app_admin_classroom_delete')]
    public function deleteLessonById(Classroom $classroom, ClassroomRepository $classroomRepository): Response
    {
        $classroomRepository->remove($classroom, true);

        return $this->redirectToRoute('app_admin_classroom', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/classroom/{classroom}', name: 'app_admin_classroom_id')]
    public function showClassroom(Classroom $classroom, ClassroomRepository $classroomRepository, UserRepository $userRepository): Response
    {
        $c = $classroomRepository->find($classroom);

        $users = $userRepository->findUserByClassroom($c);

        return $this->render('back/classroom/classroom.html.twig', [
            'classroom' => $c,
            'users' => $users,
        ]);
    }
}