<?php

namespace App\Entity;

use App\Repository\YearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YearRepository::class)]
class Year
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'year')]
    private ?Career $career = null;

    #[ORM\OneToMany(targetEntity: QuarterPeriod::class, mappedBy: 'year')]
    private Collection $quarterperiod;

    public function __construct()
    {
        $this->quarterperiod = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCareer(): ?Career
    {
        return $this->career;
    }

    public function setCareer(?Career $career): static
    {
        $this->career = $career;

        return $this;
    }

    /**
     * @return Collection<int, QuarterPeriod>
     */
    public function getQuarterperiod(): Collection
    {
        return $this->quarterperiod;
    }

    public function addQuarterperiod(QuarterPeriod $quarterperiod): static
    {
        if (!$this->quarterperiod->contains($quarterperiod)) {
            $this->quarterperiod->add($quarterperiod);
            $quarterperiod->setYear($this);
        }

        return $this;
    }

    public function removeQuarterperiod(QuarterPeriod $quarterperiod): static
    {
        if ($this->quarterperiod->removeElement($quarterperiod)) {
            // set the owning side to null (unless already changed)
            if ($quarterperiod->getYear() === $this) {
                $quarterperiod->setYear(null);
            }
        }

        return $this;
    }
}
