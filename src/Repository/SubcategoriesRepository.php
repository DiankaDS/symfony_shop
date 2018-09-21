<?php

namespace App\Repository;

use App\Entity\Subcategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subcategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subcategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subcategories[]    findAll()
 * @method Subcategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubcategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subcategories::class);
    }

    /**
     * @param $id
     * @return array
     */
    public function getSubcategoriesByCategory($id): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.category = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $qb->execute();
    }


//    /**
//     * @return Subcategories[] Returns an array of Subcategories objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subcategories
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
