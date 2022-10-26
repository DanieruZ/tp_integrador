<?php

namespace DAO;

use Models\Book as Book;
use DAO\IBookDAO as IBookDAO;
use DAO\Connection as Connection;

class BookDAO implements IBookDAO {

  private $bookList = array();
  private $connection;

  public function addBook(Book $book) {
    try {

      $query = "INSERT INTO book (startDate, endDate, state) 
                VALUES (:startDate, :endDate, :state)";

      $parameters['startDate'] = $book->getStartDate();
      $parameters['endDate'] = $book->getEndDate();
      $parameters['state'] = $book->getState();

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Lista todas las reservas.
  public function getAllBook() {
    try {
     
      $bookList = array();

      $query = "SELECT * FROM book;";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDate($value['startDate']);
        $book->setEndDate($value['endDate']);
        $book->setState($value['state']);

        array_push($bookList, $book);
      }

      return $bookList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Lista todas las reservas activas.
  public function getActiveBook() {
    try {
     
      $bookList = array();

      $query = "SELECT * FROM book
                WHERE state = 1;";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDate($value['startDate']);
        $book->setEndDate($value['endDate']);
        $book->setState($value['state']);

        array_push($bookList, $book);
      }

      return $bookList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

}

?>