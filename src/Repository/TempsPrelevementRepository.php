<?php

namespace App\Repository;

use App\Entity\TempsPrelevement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TempsPrelevement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TempsPrelevement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TempsPrelevement[]    findAll()
 * @method TempsPrelevement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TempsPrelevementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TempsPrelevement::class);
    }

    // /**
    //  * @return TempsPrelevement[] Returns an array of TempsPrelevement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TempsPrelevement
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
