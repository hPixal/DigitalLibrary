<?php

namespace App\Repository;

use App\Entity\QuarterPeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuarterPeriod>
 *
 * @method QuarterPeriod|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuarterPeriod|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuarterPeriod[]    findAll()
 * @method QuarterPeriod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuarterPeriodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuarterPeriod::class);
    }

    //    /**
    //     * @return QuarterPeriod[] Returns an array of QuarterPeriod objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('q.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?QuarterPeriod
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
