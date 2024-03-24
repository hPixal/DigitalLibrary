<?php

namespace App\Entity;

use App\Repository\CareerRepository;
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
}
