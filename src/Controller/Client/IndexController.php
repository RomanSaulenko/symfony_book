<?php


namespace App\Controller\Client;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/",  methods={"GET"})
     */
    public function index()
    {
        return $this->redirectToRoute('author_list');
    }
}