<?php


namespace App\Controller;

use App\Form\Book\CreateType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorTrait;

/**
 * @Route("/books", name="book_")
 */
class BookController extends AbstractController
{
    use TranslatorTrait;

    protected $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/create", name="create", methods={"GET"})
     */
    public function create()
    {
        $form = $this->createForm(CreateType::class);

        return $this->render('book/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(string $id)
    {
        $this->repository->delete($id);
        $this->addFlash('success', $this->trans('Author is deleted'));

        return $this->redirectToRoute('author_list');
    }

    /**
     * @Route("", name="list", methods={"GET"})
     */
    public function list()
    {
        $books = $this->repository->findAll();

        return $this->render('book/list.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * @Route("", name="store", methods={"POST"})
     */
    public function store(Request $request)
    {
        $form = $this->createForm(CreateType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $this->repository->store($author);

            $this->addFlash('success', $this->trans('book.added'));

            return $this->redirectToRoute('book_list');
        } else {
            return $this->render('book/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

}