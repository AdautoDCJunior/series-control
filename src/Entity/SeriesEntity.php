<?php

namespace App\Entity;

use App\Repository\SeriesRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(SeriesRepository::class)]
#[Table('series')]
class SeriesEntity
{
    #[Id, GeneratedValue, Column]
    private int $id;

    public function __construct(
        #[Column]
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