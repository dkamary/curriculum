<?php

namespace App\Repository;

use App\Entity\Job;
use App\Entity\User;
use App\Entity\UserMotivation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Get Candidates
     *
     * @param integer $page
     * @param integer $perPage
     * @param array $order
     * @param Job|null $job
     * @return array
     */
    public function getCandidates(
        int $page = 1,
        int $perPage = 10,
        ?array $order = null,
        ?Job $job = null
    ): array {
        $qb = $this->createQueryBuilder('u');
        if ($job) {
            $qb->where($qb->expr()->eq('um.job', $job));
        }
        if (is_array($order)) {
            foreach ($order as $field => $way) {
                $qb->addOrderBy($field, $way);
            }
        }
        $candidates = $qb
            ->join(UserMotivation::class, 'um', Expr\Join::WITH, 'u.id = um.user')
            ->setMaxResults($perPage)
            ->setFirstResult(($page > 0) ? ($page - 1) * $perPage : 0)
            ->getQuery()
            ->getResult();

        return $candidates;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
