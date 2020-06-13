<?php

namespace App\Repository;

use App\Entity\BookImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookImage[]    findAll()
 * @method BookImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookImage::class);
    }

    // /**
    //  * @return BookImage[] Returns an array of BookImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookImage
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
