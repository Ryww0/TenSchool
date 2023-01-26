<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Classroom::class, inversedBy: 'tests')]
    private Collection $classrooms;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Render::class)]
    private Collection $renders;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Question::class)]
    private Collection $questions;

    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
        $this->renders = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Classroom>
     */
    public function getClassrooms(): Collection
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom): self
    {
        if (!$this->classrooms->contains($classroom)) {
            $this->classrooms->add($classroom);
        }

        return $this;
    }

    public function removeClassroom(Classroom $classroom): self
    {
        $this->classrooms->removeElement($classroom);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Render>
     */
    public function getRenders(): Collection
    {
        return $this->renders;
    }

    public function addRender(Render $render): self
    {
        if (!$this->renders->contains($render)) {
            $this->renders->add($render);
            $render->setTest($this);
        }

        return $this;
    }

    public function removeRender(Render $render): self
    {
        if ($this->renders->removeElement($render)) {
            // set the owning side to null (unless already changed)
            if ($render->getTest() === $this) {
                $render->setTest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setTest($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getTest() === $this) {
                $question->setTest(null);
            }
        }

        return $this;
    }
}
