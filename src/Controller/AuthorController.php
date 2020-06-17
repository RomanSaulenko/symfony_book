<?php


namespace App\Controller;


use App\Form\Author\CreateType;
use App\Form\Author\EditType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorTrait;

/**
 * @Route("/authors", name="author_")
 */
class AuthorController extends AbstractController
{
    use TranslatorTrait;

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
        $form = $this->createForm(CreateType::class);

        return $this->render('author/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"GET"})
     */
    public function edit(string $id)
    {
        $author = $this->repository->find($id);
        $form = $this->createForm(EditType::class, $author);

        return $this->render('author/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(string $id)
    {
        $this->repository->delete($id);
        $this->addFlash('success', $this->trans('author.deleted'));

        return $this->redirectToRoute('author_list');
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

            $this->addFlash('success', $this->trans('author.added'));

            return $this->redirectToRoute('author_list');
        } else {
            return $this->render('author/create.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="update", methods={"PUT"})
     */
    public function update(Request $request, string $id){
        $author = $this->repository->find($id);

        $form = $this->createForm(EditType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $this->repository->store($author);
            $this->addFlash('success', $this->trans("author.data is updated"));

            return $this->redirectToRoute('author_list');
        } else {

            return $this->render('author/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

}