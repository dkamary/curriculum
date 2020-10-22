<?php

namespace App\Repository;

use App\Entity\LanguageList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LanguageList|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageList|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageList[]    findAll()
 * @method LanguageList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageList::class);
    }

    // /**
    //  * @return LanguageList[] Returns an array of LanguageList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LanguageList
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
