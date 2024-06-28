<?php
// src/Controller/LibraryController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController {
    #[Route("/", name: "app_home")]
    public function index(): Response {
        return $this->render('library/index.html.twig', [
            'message' => 'Bienvenue à la bibliothèque',
        ]);
    }
}
