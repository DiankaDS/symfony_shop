<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Users::class);
    }

//    public function loadUserByUsername($username)
//    {
//        return $this->createQueryBuilder('u')
//            ->where('u.username = :username OR u.email = :email')
//            ->setParameter('username', $username)
//            ->setParameter('email', $username)
//            ->getQuery()
//            ->getOneOrNullResult();
//    }
}
