<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Book;

/**
 * @Route("/api/books")
 */
class BookController extends AbstractController
{
    /**
     * @Route("")
     */
    public function list(BookRepository $bookRepository)
    {
        $results = array_map(function($book) {
            return $book->toArray();
        }, $bookRepository->findAll());

        return new JsonResponse($results);
    }

    /**
     * @Route("/{id}")
     */
    public function one(Book $book)
    {
        return new JsonResponse($book->toArray());
    }
}
