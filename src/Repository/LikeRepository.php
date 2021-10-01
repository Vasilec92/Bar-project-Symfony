<?php

namespace App\Repository;

use App\Entity\Like;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Like|null find($id, $lockMode = null, $lockVersion = null)
 * @method Like|null findOneBy(array $criteria, array $orderBy = null)
 * @method Like[]    findAll()
 * @method Like[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Like::class);
    }

     /**
      * @return Like[] Returns an array of Like objects
      */
    public function findByuser($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.user = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

     /**
      * @return Like[] Returns an array of Like objects
      */
      public function findByCorrespondance($value, $value_)
      {
          return $this->createQueryBuilder('l')
              ->andWhere('l.user = :val')
              ->setParameter('val', $value)
              ->andWhere('l.beer = :val_')
              ->setParameter('val_', $value_)
              ->orderBy('l.id', 'ASC')
              ->getQuery()
              ->getResult()
          ;
      }
  
  
    
    

    /*
    public function findOneBySomeField($value): ?Like
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
