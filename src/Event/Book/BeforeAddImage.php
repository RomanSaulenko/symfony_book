<?php


namespace App\Event\Book;


use App\Entity\Book;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeAddImage extends Event
{
    protected $book;
    protected $imageDirectory;

    public function __construct(Book $book, $imageDirectory)
    {
        $this->book = $book;
        $this->imageDirectory = $imageDirectory;
    }

    public function getBook()
    {
        return $this->book;
    }

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }
}