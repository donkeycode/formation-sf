<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Form\AuthorType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BookController extends AbstractController
{
    /**
     * @Route("/books/{book}", requirements={"book": "\d+"}, methods={"GET"}, name="book")
     * @IsGranted("BOOK_READ", subject="book")
     */
    public function getBook(Book $book, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->dispatch(new GenericEvent($book), "new_user");
        
        return $this->render('book/index.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/books/new", name="new_book")
     */
    public function newBook(Request $request)
    {        
        $form = $this->createForm(AuthorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            // Save
        }

        return $this->render('book/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
