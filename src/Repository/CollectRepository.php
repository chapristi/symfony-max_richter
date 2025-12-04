<?php

namespace App\Repository;

use App\Entity\Collect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Collect>
 */
class CollectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Collect::class);
    }

    public function findUsersWithGameCount(): array
    {
        return $this->createQueryBuilder('c')
            ->select('u.id, u.prenom, u.mail, u.pseudo, COUNT(c.id) as gameCount')
            ->join('c.utilisateur', 'u')
            ->groupBy('u.id, u.prenom, u.mail, u.pseudo')
            ->getQuery()
            ->getArrayResult();
    }

    public function findCollectionByUtilisateur(int $utilisateurId): array
    {
        return $this->createQueryBuilder('c')
            ->select('c', 'j')
            ->join('c.jeuvideo', 'j')
            ->andWhere('c.utilisateur = :user_id')
           ->setParameter('user_id', $utilisateurId)
            ->getQuery()
            ->getResult();
    }

    public function findOneCollectionItemByCollectAndUser(int $collectId): ?Collect
    {
        return $this->createQueryBuilder('c')
            ->select('c', 'j', 'u')
            ->join('c.jeuvideo', 'j')
            ->join('c.utilisateur', 'u')
            ->andWhere('c.id = :collect_id')
            ->setParameter('collect_id', $collectId)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
