<?php

namespace App\Entity;

use App\Repository\SeriesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(SeriesRepository::class)]
#[ORM\Table('series')]
class SeriesEntity
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private int $id;

    public function __construct(
        #[ORM\Column, Assert\NotBlank, Assert\Length(min: 5)]
        private string $name = ''
    ) { }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $newName): void
    {
        $this->name = $newName;
    }
}