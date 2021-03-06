<?php

namespace App\Repository;

use App\Entity\Etude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Etude|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etude|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etude[]    findAll()
 * @method Etude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etude::class);
    }



    // /**
    //  * @return Etude[] Returns an array of Etude objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etude
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Etude[]
     */
    public function findProduit(): array
    {
        $qb = $this->createQueryBuilder("e");

        $qb->select("e.numero", "produit")
            ->innerJoin("etude.produit", "p");

        return $qb->getQuery()->getResult();
    }


    public function findLatest(): array
    {
        return $this->createQueryBuilder('e')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @param $idEtude
//     * @return Etude[]
//     */
//    public function findByNumero($idEtude): array
//    {
//        return $this->createQueryBuilder('e')
//            //->select('e.numero, p.id, p.groupe, p.voieAdmin, p.idProduitPorsolt, p.nbreAnimaux, p.datePremierPrelevement')
//            ->where('e.numero = ?1')
//            //->where('p.id = 7')
//            //->from(Etude::class, 'etude')
//            //->leftJoin('e.produits', 'p')
//            //->groupBy('e.numero')
//            //->groupBy('p.groupe')
//            ->setParameter(1,$idEtude)
//            ->getQuery()
//            ->getResult();
//
//    }
}