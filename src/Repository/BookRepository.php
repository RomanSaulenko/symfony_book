<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function store(Book $book):?Book
    {
        try {
            $this->_em->persist($book);
            $this->_em->flush();
        } catch (ORMException $exception) {
            return null;
        }
        return $book;
    }

    public function delete(string $bookId): bool
    {
        $book = $this->find($bookId);

        try {
            $this->_em->remove($book);
            $this->_em->flush();
        } catch (ORMException $exception) {
            return false;
        }
        return true;
    }

}
