<?php


namespace App\Controller;

use App\Event\Book\BeforeAddImage;
use App\Form\Book\CreateType;
use App\Form\Book\EditType;
use App\Repository\BookRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Translation\TranslatorTrait;

/**
 * @Route("/books", name="book_")
 */
class BookController extends AbstractController
{
    use TranslatorTrait;

    /**
     * @var ParameterBagInterface
     */
    protected $parameterBag;
    /**
     * @var BookRepository
     */
    protected $repository;
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    public function __construct(BookRepository $repository, ParameterBagInterface $parameterBag, EventDispatcherInterface $dispatcher)
    {
        $this->repository = $repository;
        $this->parameterBag = $parameterBag;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(Request $request, FileUploader $fileUploader)
    {
        $form = $this->createForm(CreateType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image_file')->getData();
            if ($imageFile) {
                $imageDir = $this->parameterBag->get('app.book_image_directory');
                $fileUploader->setFileDirectory($imageDir);
                $imageFileName = $fileUploader->upload($imageFile);
                $book->setImage($imageFileName);
            }
            $this->repository->store($book);

            $this->addFlash('success', $this->trans('book.added'));

            return $this->redirectToRoute('book_list');
        }

        return $this->render('book/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="edit", methods={"GET", "PUT"})
     */
    public function edit(Request $request, FileUploader $fileUploader, string $id)
    {
        $book = $this->repository->find($id);

        $form = $this->createForm(EditType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image_file')->getData();

            if ($imageFile) {
                $bookImageDir = $this->parameterBag->get('app.book_image_directory');

                $this->dispatcher->dispatch(new BeforeAddImage($book, $bookImageDir));

                $fileUploader->setFileDirectory($bookImageDir);
                $imageFileName = $fileUploader->upload($imageFile);
                $book->setImage($imageFileName);
            }

            $this->repository->store($book);
            $this->addFlash('success', $this->trans("book.data is updated"));

            return $this->redirectToRoute('book_list');
        }

        return $this->render('book/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(string $id)
    {
        $this->repository->delete($id);
        $this->addFlash('success', $this->trans('Book is deleted'));

        return $this->redirectToRoute('book_list');
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

}