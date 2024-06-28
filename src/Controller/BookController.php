<?php
// src/Controller/BookController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;

class BookController extends AbstractController {
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route("/books", name:"book_list")]
    public function list(): Response {
        $books = $this->entityManager->getRepository(Book::class)->createQueryBuilder('b')
            ->select('b')
            ->getQuery()
            ->getResult();

        return $this->render('book/list.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route("/book/{id}", name:"book_detail")]
    public function detail($id): Response{


    }
}