<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorie>
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    /**
     * @return Categorie[] Returns an array of Categorie objects
     */
    public function list(): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
        ;
    }

    /**
     * @return array categorie[] with most product
     */
    public function findCategoriesPhares(int $nbr) : array
    {

        return $this->createQueryBuilder('c')
            ->addSelect('COUNT(DISTINCT c.id) as HIDDEN nbr')
            ->innerJoin('c.produit', 'p')
            ->groupBy('c.id')
            ->orderBy('nbr', 'DESC')
            ->setMaxResults($nbr)
            ->getQuery()
            ->getResult()
     ;
    }

    //    public function findOneBySomeField($value): ?Categorie
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
