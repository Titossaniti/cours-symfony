<?php

// src/Controller/BookController.php
namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private $bookRepository;
    private $entityManager;

    public function __construct(BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        $this->bookRepository = $bookRepository;
        $this->entityManager = $entityManager;
    }


#[Route('/books', name: 'book_list')]
public function index(BookRepository $bookRepository): Response
{
$books = $bookRepository->findAll();

    return $this->render('book/list.html.twig', [
        'books' => $books
]);
}

#[Route('/books/new', name: 'book_new')]
public function new(Request $request): Response
{
    $book = new Book();
    $form = $this->createForm(BookType::class, $book);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return $this->redirectToRoute('book_list');
    }
    return $this->render('book/new.html.twig', [
        'form' => $form->createView(),
    ]);
}

#[Route("/books/{id}", name:"book_detail")]
public function detail(BookRepository $bookRepository, $id): Response
{
    $book = $bookRepository->find($id);

    return $this->render('book/detail.html.twig', ['book' => $book]);

}

}