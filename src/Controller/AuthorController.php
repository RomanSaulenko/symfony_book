<?php


namespace App\Controller;


use App\Repository\AuthorMysqlRepository;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/authors", name="authors_")
 */
class AuthorController extends AbstractController
{
    /**
     * @var AuthorRepository
     */
    protected $repository;

    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("", name="list", methods={"GET"})
     */
    public function list()
    {
        return $this->render();
    }

    /**
     * @Route("/create", name="create", methods={"GET"})
     */
    public function create(AuthorRepository $repository)
    {
    }

    /**
     * @Route("", name="store", methods={"POST"})
     */
    public function store(){}

    /**
     * @Route("", name="update", methods={"PUT"})
     */
    public function update(){}

}