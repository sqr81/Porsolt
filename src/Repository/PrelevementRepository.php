<?php

namespace App\Repository;

use App\Entity\Prelevement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Prelevement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prelevement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prelevement[]    findAll()
 * @method Prelevement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrelevementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prelevement::class);
    }

    // /**
    //  * @return Prelevement[] Returns an array of Prelevement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prelevement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
