<?php

namespace App\Entity;

use App\Repository\CareerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CareerRepository::class)]
class Career
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $careerName = null;

    #[ORM\OneToMany(targetEntity: Year::class, mappedBy: 'career')]
    private Collection $year;

    public function __construct()
    {
        $this->year = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCareerName(): ?string
    {
        return $this->careerName;
    }

    public function setCareerName(string $careerName): static
    {
        $this->careerName = $careerName;

        return $this;
    }

    /**
     * @return Collection<int, Year>
     */
    public function getYear(): Collection
    {
        return $this->year;
    }

    public function addYear(Year $year): static
    {
        if (!$this->year->contains($year)) {
            $this->year->add($year);
            $year->setCareer($this);
        }

        return $this;
    }

    public function removeYear(Year $year): static
    {
        if ($this->year->removeElement($year)) {
            // set the owning side to null (unless already changed)
            if ($year->getCareer() === $this) {
                $year->setCareer(null);
            }
        }

        return $this;
    }
}
