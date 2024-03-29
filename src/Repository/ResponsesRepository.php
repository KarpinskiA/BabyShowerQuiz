<?php

namespace App\Repository;

use App\Entity\Responses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Responses>
 *
 * @method Responses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Responses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Responses[]    findAll()
 * @method Responses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Responses::class);
    }

    public function saveBabyResponse($answer, $user, $babyQuestion): Responses
    {
        $response = new Responses();

        $response->setResponse($answer);
        $response->setPerson($user);
        $response->setBabyQuestion($babyQuestion);

        $this->getEntityManager()->persist($response);
        $this->getEntityManager()->flush();

        return $response;
    }

    public function saveParentResponse($answer, $user, $parentsQuestion): Responses
    {
        $response = new Responses();

        $response->setResponse($answer);
        $response->setPerson($user);
        $response->setParentQuestion($parentsQuestion);

        $this->getEntityManager()->persist($response);
        $this->getEntityManager()->flush();

        return $response;
    }

    //    /**
    //     * @return Responses[] Returns an array of Responses objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Responses
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
