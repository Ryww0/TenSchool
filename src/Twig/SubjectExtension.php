<?php

namespace App\Twig;

use App\Repository\SubjectRepository;
use Symfony\Component\Security\Core\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SubjectExtension extends AbstractExtension
{

    public function __construct(private SubjectRepository $subjectRepository, private Security $security)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_all_subject', [$this, 'getAllSubjects']),
        ];
    }

    public function getAllSubjects(): array
    {
        $user = $this->security->getUser()->getClassroom();

        return $this->subjectRepository->findAllSubjectWhereUserConnectedClassroomIdIsEqualToClassroomId($user);
    }
}