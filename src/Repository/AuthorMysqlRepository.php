<?php


namespace App\Repository;


use App\Entity\Author;
use Doctrine\ORM\ORMException;

class AuthorMysqlRepository extends AuthorRepository
{
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