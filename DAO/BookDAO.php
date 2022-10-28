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

      $query = "INSERT INTO book (startDate, endDate, state, petId) 
                VALUES (:startDate, :endDate, :state, :petId)";

      $parameters['startDate'] = $book->getStartDate();
      $parameters['endDate'] = $book->getEndDate();
      $parameters['state'] = $book->getState();
      $parameters['petId'] = $book->getPetId();

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
        $book->setPetId($value['petId']);

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
        $book->setPetId($value['petId']);

        array_push($bookList, $book);
      }

      return $bookList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Trae el ultimo id de reservas.
  public function getBookLastId() {
    try {
      $query = "SELECT MAX(bookId) FROM book;"; 

      $this->connection = Connection::GetInstance();
      $bookId = $this->connection->Execute($query);
      
      return $bookId;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Agrega los ids en la tabla de muchos a muchos.
  public function addPersonBook($keeperId) {
    try {
      $user = $_SESSION['owner'];
      [$person] = $user;      
      $ownerId = $person->getPersonId();

      $lastId = $this->getBookLastId();
      [$book] = $lastId;
      $bookId = $book[0];

      $query = "INSERT INTO person_book (ownerId, keeperId, bookId)
                VALUES (:ownerId, :keeperId, :bookId);";
               
      $parameters['ownerId'] = $ownerId;          
      $parameters['keeperId'] = $keeperId;
      $parameters['bookId'] = $bookId;
       
      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

}

?>