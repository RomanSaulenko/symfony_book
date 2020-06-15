<?php


namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/authors", name="book_")
 */
class BookController extends AbstractController
{
    protected $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("", name="list", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list()
    {
        $books = $this->repository->findAll();

        return $this->render('book/list.html/twig', [
            'books' => $books
        ]);
    }
}