<?php

namespace App\Repository;

use App\Entity\ParentsQuestions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ParentsQuestions>
 *
 * @method ParentsQuestions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParentsQuestions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParentsQuestions[]    findAll()
 * @method ParentsQuestions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentsQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParentsQuestions::class);
    }

    /**
     * @return ParentsQuestions[] Returns an array of ParentsQuestions objects with only the id and question fields
     */
    public function findAllParentsQuestions(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.question')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return ParentsQuestions[] Returns an array of ParentsQuestions objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ParentsQuestions
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
