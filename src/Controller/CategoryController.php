<?php

// src/Controller/CategoryController.php
namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'category_list')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/list.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route("/categories/{id}", name:"category_detail")]
    public function detail(CategoryRepository $categoryRepository, $id): Response
    {
        $category = $categoryRepository->find($id);

        return $this->render('category/detail.html.twig', ['category' => $category]);

    }
}
