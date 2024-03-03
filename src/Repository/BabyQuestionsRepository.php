<?php

namespace App\Repository;

use App\Entity\BabyQuestions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BabyQuestions>
 *
 * @method BabyQuestions|null find($id, $lockMode = null, $lockVersion = null)
 * @method BabyQuestions|null findOneBy(array $criteria, array $orderBy = null)
 * @method BabyQuestions[]    findAll()
 * @method BabyQuestions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BabyQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BabyQuestions::class);
    }

//    /**
//     * @return BabyQuestions[] Returns an array of BabyQuestions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BabyQuestions
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
