<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'subjects')]
    private ?self $subject = null;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: self::class)]
    private Collection $subjects;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Lesson::class)]
    private Collection $lessons;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
        $this->lessons = new ArrayCollection();
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

    public function getSubject(): ?self
    {
        return $this->subject;
    }

    public function setSubject(?self $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(self $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects->add($subject);
            $subject->setSubject($this);
        }

        return $this;
    }

    public function removeSubject(self $subject): self
    {
        if ($this->subjects->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getSubject() === $this) {
                $subject->setSubject(null);
            }
        }

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
            $lesson->setSubject($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getSubject() === $this) {
                $lesson->setSubject(null);
            }
        }

        return $this;
    }
}
