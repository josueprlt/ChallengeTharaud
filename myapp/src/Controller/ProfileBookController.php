<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProfileBookController extends AbstractController
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    #[Route('/book/{id}', name: 'app_profile_book')]
    public function index(int $id): Response
    {
        $book = $this->bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('book not found');
        }

        return $this->render('profile_book/index.html.twig', [
            'controller_name' => 'ProfileBookController',
            'book' => $book,
        ]);
    }
}