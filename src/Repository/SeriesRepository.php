<?php

namespace App\Repository;

use App\Entity\SeriesEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SeriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeriesEntity::class);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    public function add(SeriesEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SeriesEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        } 
    }

    public function removeById(int $id, bool $flush = true): void
    {
        $series = $this->getEntityManager()
            ->getPartialReference(SeriesEntity::class, $id);
        $this->remove($series, $flush);
    }
}