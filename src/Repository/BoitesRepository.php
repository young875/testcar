<?php

namespace App\Repository;

use App\Entity\Boites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Boites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Boites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Boites[]    findAll()
 * @method Boites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Boites::class);
    }

    // /**
    //  * @return Boites[] Returns an array of Boites objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Boites
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
