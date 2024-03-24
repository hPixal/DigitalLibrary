<?php

namespace App\Entity;

use App\Repository\QuarterPeriodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuarterPeriodRepository::class)]
class QuarterPeriod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'quarterperiod')]
    private ?Year $year = null;

    #[ORM\OneToMany(targetEntity: Subject::class, mappedBy: 'quarterPeriod')]
    private Collection $subject;

    public function __construct()
    {
        $this->subject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?Year
    {
        return $this->year;
    }

    public function setYear(?Year $year): static
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubject(): Collection
    {
        return $this->subject;
    }

    public function addSubject(Subject $subject): static
    {
        if (!$this->subject->contains($subject)) {
            $this->subject->add($subject);
            $subject->setQuarterPeriod($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): static
    {
        if ($this->subject->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getQuarterPeriod() === $this) {
                $subject->setQuarterPeriod(null);
            }
        }

        return $this;
    }
}
