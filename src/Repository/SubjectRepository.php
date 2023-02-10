<?php

namespace App\Repository;

use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subject>
 *
 * @method Subject|null     find($id, $lockMode = null, $lockVersion = null)
 * @method Subject|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subject[]    findAll()
 * @method Subject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subject::class);
    }

    public function save(Subject $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Subject $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllSubjectWhereUserConnectedClassroomIdIsEqualToClassroomId($user) {
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->join("App\Entity\Lesson", "lesson", Join::WITH, 's.id = lesson.subject') // joined lesson
            ->join('lesson.classrooms', 'classroom')
            ->where('classroom.id = :user')
            ->setParameter(':user', $user)
            ->orderBy('s.id', 'DESC')
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    public function noName($user, $subject) {
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder
            ->select('s as subject') // I want all subjects
            ->join("App\Entity\Lesson", "lesson", Join::WITH, 's.id = lesson.subject') // joined lesson
            ->join('lesson.classrooms', 'classroom')
            ->where('classroom.id = :user')
            ->setParameter(':user', $user)
            ->andWhere('s.id = :subject')
            ->setParameter(':subject', $subject)
        ;

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

//    /**
//     * @return Subject[] Returns an array of Subject objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Subject
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
