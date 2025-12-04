<?php

namespace App\Repository;

use App\Entity\JeuVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JeuVideo>
 */
class JeuVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JeuVideo::class);
    }
    public function findAllWithOwners(): array
    {
        return $this->createQueryBuilder('j')
            ->select('j', 'g', 'e', 'd', 'c', 'u')

            ->leftJoin('j.genre', 'g')
            ->leftJoin('j.editeur', 'e')
            ->leftJoin('j.developpeur', 'd')

            ->leftJoin('j.collects', 'c')
            ->leftJoin('c.utilisateur', 'u')

            ->getQuery()
            ->getResult();
    }


}
