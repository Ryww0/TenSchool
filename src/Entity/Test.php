<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\ManyToOne(inversedBy: 'tests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Render::class)]
    private Collection $renders;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Question::class)]
    private Collection $questions;

    #[ORM\Column]
    private ?bool $available;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\OneToMany(mappedBy: 'test', targetEntity: SessionTest::class)]
    private Collection $sessionTests;

    public function __construct()
    {
        $this->renders = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->sessionTests = new ArrayCollection();
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

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, SessionTest>
     */
    public function getSessionTests(): Collection
    {
        return $this->sessionTests;
    }

    public function addSessionTest(SessionTest $sessionTest): self
    {
        if (!$this->sessionTests->contains($sessionTest)) {
            $this->sessionTests->add($sessionTest);
            $sessionTest->setTest($this);
        }

        return $this;
    }

    public function removeSessionTest(SessionTest $sessionTest): self
    {
        if ($this->sessionTests->removeElement($sessionTest)) {
            // set the owning side to null (unless already changed)
            if ($sessionTest->getTest() === $this) {
                $sessionTest->setTest(null);
            }
        }

        return $this;
    }
}
