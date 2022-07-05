<?php

namespace Source\Models;

use \Source\Models\DataLayer;
use \PDO;

class BookModel
{
    public static function addBook($book)
    {
        try {
            $bookId = (new DataLayer())->insert("book", [
                "AuthorId" => $book["author"],
                "PublishingCompanyId" => $book["publishingCompany"],
                "CoverTypeId" => $book["coverType"],
                "Name" => $book["name"],
                "Description" => $book["description"],
                "Publication" => date_format(date_create($book["publication"]), "Y-m-d"),
                "Edition" => $book["edition"],
                "NumberPages" => $book["numberPages"],
                "IsActive" => $book["isActive"]
            ]);

            // Fazer upload da imagem da capa para o servidor.
            move_uploaded_file(
                $_FILES["coverImage"]["tmp_name"], 
                $_SERVER['DOCUMENT_ROOT'] . "/paper-online-library/source/wwwroot/img/book/$bookId." . strtolower(pathinfo($_FILES["coverImage"]["name"],PATHINFO_EXTENSION)));

            return $bookId;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function getBooks()
    {
        try {
            $dlName = DL_DBNAME;

            $query = "SELECT book.BookId,
                author.AuthorId,
                author.Name AS AuthorName,
                publishingcompany.PublishingCompanyId,
                publishingcompany.Name AS PublishingCompanyName,
                covertype.CoverTypeId,
                covertype.Name AS CoverTypeName,
                book.CreateIn,
                book.Name,
                book.Description,
                book.Publication,
                book.Edition,
                book.NumberPages,
                book.IsActive

                FROM $dlName.book,
                $dlName.author,
                $dlName.publishingcompany,
                $dlName.covertype

                WHERE book.AuthorId = author.AuthorId
                AND book.PublishingCompanyId = publishingcompany.PublishingCompanyId 
                AND book.CoverTypeId = covertype.CoverTypeId
                AND book.IsActive = true";

            return (new DataLayer())->select($query)->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function getBook($bookId)
    {
        try {
            $dlName = DL_DBNAME;

            $query = "SELECT book.BookId,
                author.AuthorId,
                author.Name AS AuthorName,
                publishingcompany.PublishingCompanyId,
                publishingcompany.Name AS PublishingCompanyName,
                covertype.CoverTypeId,
                covertype.Name AS CoverTypeName,
                book.CreateIn,
                book.Name,
                book.Description,
                book.Publication,
                book.Edition,
                book.NumberPages,
                book.IsActive

                FROM $dlName.book,
                $dlName.author,
                $dlName.publishingcompany,
                $dlName.covertype

                WHERE book.AuthorId = author.AuthorId
                AND book.PublishingCompanyId = publishingcompany.PublishingCompanyId 
                AND book.CoverTypeId = covertype.CoverTypeId
                AND book.BookId = $bookId";

            $book = (new DataLayer())->select($query)->fetchAll(PDO::FETCH_OBJ);

            return count($book) > 0 ? $book[0] : null;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
