<?php


namespace App\Controller;


use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/authors", name="author_")
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
        $author = new Author();


        $authors = $this->repository->findAll();

        return $this->render('author/list.html.twig', [
            'authors' => $authors
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET"})
     */
    public function create()
    {
        $form = $this->createForm(AuthorType::class);

        return $this->render('author/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("", name="store", methods={"POST"})
     */
    public function store(Request $request)
    {
        $form = $this->createForm(AuthorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $this->repository->store($task);

            return $this->redirectToRoute('task_success');
        }


    }

    /**
     * @Route("", name="update", methods={"PUT"})
     */
    public function update(){}

}