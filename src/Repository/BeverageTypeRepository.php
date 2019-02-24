<?php

namespace App\Repository;

use App\Entity\BeverageType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BeverageType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeverageType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeverageType[]    findAll()
 * @method BeverageType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeverageTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BeverageType::class);
    }

    // /**
    //  * @return BeverageType[] Returns an array of BeverageType objects
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
    public function findOneBySomeField($value): ?BeverageType
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
