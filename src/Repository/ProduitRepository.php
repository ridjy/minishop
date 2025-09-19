<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     * @return QueryBuilder
     */
    public function list(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
        ;
    }

    /**
     * @return array Produit[] with most sales
     */
    public function findProduitPhares(int $nbr) : array
    {

        return $this->createQueryBuilder('p')
            ->addSelect('COUNT(DISTINCT p.id) as HIDDEN nbr')
            ->innerJoin('p.ligneCommandes', 'l')
            ->groupBy('p.id')
            ->orderBy('nbr', 'DESC')
            ->setMaxResults($nbr)
            ->getQuery()
            ->getResult()
            ;
    }

    //    public function findOneBySomeField($value): ?Produit
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
