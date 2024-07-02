<?php

// src/Controller/AuthorController.php
namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    private $authorRepository;
    private $entityManager;

    public function __construct(AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        $this->authorRepository = $authorRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/authors', name: 'author_list')]
    public function index(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();

        return $this->render('author/list.html.twig', [
            'authors' => $authors
        ]);
    }

    #[Route('/authors/new', name: 'author_new')]
    public function new(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($author);
            $this->entityManager->flush();

            return $this->redirectToRoute('author_list');
        }
        return $this->render('author/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/authors/{id}", name:"author_detail")]
    public function detail(AuthorRepository $authorRepository, $id): Response
    {
        $author = $authorRepository->find($id);

        return $this->render('author/detail.html.twig', ['author' => $author]);

    }

}