<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Book;

final class HomeController extends AbstractController
{
    private $bookRepository;
    
    public function __construct(\Doctrine\Persistence\ManagerRegistry $doctrine)
    {
        $this->bookRepository = $doctrine->getRepository(Book::class);
    }
    
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $books = $this->bookRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'books' => $books,
        ]);
    }
}
