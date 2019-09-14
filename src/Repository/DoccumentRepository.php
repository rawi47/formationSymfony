<?php

namespace App\Repository;

use App\Entity\Doccument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Doccument|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doccument|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doccument[]    findAll()
 * @method Doccument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoccumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doccument::class);
    }

    // /**
    //  * @return Doccument[] Returns an array of Doccument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Doccument
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
