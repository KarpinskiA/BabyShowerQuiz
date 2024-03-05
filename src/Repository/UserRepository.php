<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
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

    public function saveUser($userData): User
    {
        // dump($userData);
        $user = new User();

        $user->setLastname($userData['lastName']);
        $user->setFirstname($userData['firstName']);
        $user->setEmail($userData['email']);
        $user->setCreatedAt($userData['createdAt']);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    public function findUserByData($userData): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.lastname = :lastname')
            ->andWhere('u.firstname = :firstname')
            ->andWhere('u.email = :email')
            ->andWhere('u.createdAt = :createdAt')
            ->setParameter('lastname', $userData['lastName'])
            ->setParameter('firstname', $userData['firstName'])
            ->setParameter('email', $userData['email'])
            ->setParameter('createdAt', $userData['createdAt'])
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
