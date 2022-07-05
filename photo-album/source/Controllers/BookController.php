<?php

namespace Source\Controllers;

use Source\Models\AuthorModel;
use Source\Models\BookModel;
use Source\Models\CoverTypeModel;
use Source\Models\PublishingCompanyModel;

class BookController extends Controller
{
    public function get($data) 
    {
        $book = (new BookModel())->getBook($data["bookId"]);

        parent::View("book", [
            "authors" => (new AuthorModel())->getAuthors(),
            "publishingCompany" => (new PublishingCompanyModel())->getPublishingCompanys(),
            "coverTypes" => (new CoverTypeModel())->getCoverTypes(),
            "book" => $book
        ]);
    }
    
    public function create() 
    {
        parent::View("book", [
            "authors" => (new AuthorModel())->getAuthors(),
            "publishingCompany" => (new PublishingCompanyModel())->getPublishingCompanys(),
            "coverTypes" => (new CoverTypeModel())->getCoverTypes()
        ]);
    }

    // Post
    public function createSave($data) 
    {
        $bookId = (new BookModel())->addBook($data);

        header("location: /paper-online-library/book/$bookId");
    }

    public function search() 
    {
        $books = (new BookModel())->getBooks();

        parent::View("search", [
            "books" => $books 
        ]);
    }
}