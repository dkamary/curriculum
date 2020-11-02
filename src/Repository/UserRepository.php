<?php

namespace App\Repository;

use App\Entity\Job;
use App\Entity\Other;
use App\Entity\OtherSkill;
use App\Entity\Skill;
use App\Entity\SkillCategory;
use App\Entity\User;
use App\Entity\UserMotivation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\VarDumper\VarDumper;

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
        if (!is_null($job)) {
            $qb->where($qb->expr()->eq('um.job', $job->getId()));
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

    /**
     * Get Candidates by category
     *
     * @param SkillCategory $skillCategory
     * @param integer $page
     * @param integer $perPage
     * @param array|null $order
     * @param Job|null $job
     * @return array
     */
    public function getCandidatesByCategory(
        SkillCategory $skillCategory,
        int $page = 1,
        int $perPage = 10,
        ?array $order = null,
        ?Job $job = null
    ): array {
        VarDumper::dump($skillCategory);
        $qb = $this->createQueryBuilder('u')
            ->join(UserMotivation::class, 'um', Expr\Join::WITH, 'u.id = um.user')
            ->join(Other::class, 'o', Expr\Join::WITH, 'u.id = o.user')
            ->join(OtherSkill::class, 'os', Expr\Join::WITH, 'o.id = os.other')
            ->join(Skill::class, 's', 'os.skill = s.id')
            ->join(SkillCategory::class, 'sc', Expr\Join::WITH, 's.category = sc.id');
        if (!is_null($job)) {
            $qb
                ->andWhere('um.job = :job')
                ->setParameter('job', $job->getId());
        }
        if (is_array($order)) {
            foreach ($order as $field => $way) {
                $qb->addOrderBy($field, $way);
            }
        }
        $candidates = $qb
            ->andWhere('sc.id = :category')
            ->setParameter('category', $skillCategory->getId())
            ->setFirstResult(($page > 0) ? ($page - 1) * $perPage : 0)
            ->setMaxResults($perPage)
            ->getQuery();
        VarDumper::dump($candidates->getSQL());
        $candidates = $candidates
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
