<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function delete(string $id):bool
    {
        $author = $this->find($id);

        try {
            $this->_em->remove($author);
            $this->_em->flush();
        } catch (ORMException $exception) {
            return false;
        }
        return true;
    }


    public function store(Author $author):?Author
    {
        try {
            $this->_em->persist($author);
            $this->_em->flush();
        } catch (ORMException $exception) {
            return null;
        }
        return $author;
    }

}
