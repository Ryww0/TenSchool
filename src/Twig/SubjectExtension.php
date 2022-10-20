<?php

namespace App\Twig;

use App\Repository\SubjectRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SubjectExtension extends AbstractExtension
{
    /**
     * @var SubjectRepository
     */
    private SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_all_subject', [$this, 'getAllSubjects']),
        ];
    }

    public function getAllSubjects(): array
    {
        return $this->subjectRepository->findAll();
    }
}