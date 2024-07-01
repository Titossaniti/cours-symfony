<?php

// src/Controller/BookController.php
namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
#[Route('/books', name: 'book_list')]
public function index(BookRepository $bookRepository): Response
{
$books = $bookRepository->findAll();

    return $this->render('book/list.html.twig', [
        'books' => $books
]);
}

#[Route("/books/{id}", name:"book_detail")]
public function detail(BookRepository $bookRepository, $id): Response
{
    $book = $bookRepository->find($id);

    return $this->render('book/detail.html.twig', ['book' => $book]);

}

}