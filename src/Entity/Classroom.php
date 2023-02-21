<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'classroom', targetEntity: User::class)]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'classrooms')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Lesson::class, inversedBy: 'classrooms')]
    private Collection $lessons;

    #[ORM\OneToMany(mappedBy: 'classroom', targetEntity: SessionTest::class)]
    private Collection $sessionTests;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->sessionTests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setClassroom($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getClassroom() === $this) {
                $user->setClassroom(null);
            }
        }

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
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons->add($lesson);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        $this->lessons->removeElement($lesson);

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
            $sessionTest->setClassroom($this);
        }

        return $this;
    }

    public function removeSessionTest(SessionTest $sessionTest): self
    {
        if ($this->sessionTests->removeElement($sessionTest)) {
            // set the owning side to null (unless already changed)
            if ($sessionTest->getClassroom() === $this) {
                $sessionTest->setClassroom(null);
            }
        }

        return $this;
    }
}
