<?php

// src/Controller/AuthorController.php
namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/authors', name: 'author_list')]
    public function index(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();

        return $this->render('author/list.html.twig', [
            'authors' => $authors
        ]);
    }

    #[Route("/authors/{id}", name:"author_detail")]
    public function detail(AuthorRepository $authorRepository, $id): Response
    {
        $author = $authorRepository->find($id);

        return $this->render('author/detail.html.twig', ['author' => $author]);

    }

}