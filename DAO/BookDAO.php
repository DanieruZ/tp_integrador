<?php

namespace DAO;

use Models\Book as Book;
use Models\Person as Person;
use Models\Schedule as Schedule;
use Models\Pet as Pet;
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

  public function aceptReserve($bookId) {
    try {

      $bookList = array();

      $query = "UPDATE book
                SET state = 1 
                WHERE bookId = '$bookId;";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setState($value['state']);

        array_push($bookList, $book);
      }

      return $bookList;
    
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
  public function addPersonBook($keeperId,$petId) {
    try {
      $user = $_SESSION['owner'];
      [$person] = $user;      
      $ownerId = $person->getPersonId();

      $lastId = $this->getBookLastId();
      [$book] = $lastId;
      $bookId = $book[0];

      $query = "INSERT INTO person_book (ownerId,petId, keeperId, bookId)
                VALUES (:ownerId, :petId, :keeperId, :bookId);";
               
      $parameters['ownerId'] = $ownerId; 
      $parameters['petId'] = $petId;         
      $parameters['keeperId'] = $keeperId;
      $parameters['bookId'] = $bookId;
       
      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getOwnerBook($personId)
  {
    try {       


      $bookList = array();

      $query = "SELECT * FROM book b
                INNER JOIN person_book bk ON bk.bookId = b.bookId
                WHERE bk.ownerId = '$personId';";

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

  public function getKeeperBook($personId)
  {
    try {       


      $bookList = array();

      $query = "SELECT * FROM book b
                INNER JOIN person_book bk ON bk.bookId = b.bookId
                WHERE bk.keeperId = '$personId';";

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

  public function getBookInfoOwner($bookId) {
    try {
     
      $bookList = array();

      $query = "SELECT * FROM book b
                INNER JOIN person_book pbk ON pbk.bookId = b.bookId
                INNER JOIN person pk ON pk.personId = pbk.keeperId
                INNER JOIN pet pt ON pt.petId = pbk.petId
                /*INNER JOIN agenda a ON a.personId = pbk.keeperId*/
                WHERE pbk.bookId = '$bookId';";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDate($value['startDate']);
        $book->setEndDate($value['endDate']);
        $book->setState($value['state']);
/*
        $schedule = new Schedule();
        $schedule->setScheduleId($value['scheduleId']);
        $schedule->setStartDate($value['startDate']);
        $schedule->setEndDate($value['endDate']);
        $schedule->setState($value['state']);
        $schedule->setPersonId($value['personId']);
        $schedule->setSize($value['size']);
        $schedule->setPet_type($value['pet_type']);
        $schedule->setCost($value['cost']);*/
       
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setEmail($value['email']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);

        $pet = new Pet();
        $pet->setPetId($value['petId']);
        $pet->setPetname($value['petname']);
        $pet->setSize($value['size']);
        $pet->setPet_type($value['pet_type']);
        $pet->setBreed($value['breed']);

        array_push($bookList, $book, $person, $pet);
      }

      return $bookList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getBookInfoKeeper($bookId) {
    try {
     
      $bookList = array();

      $query = "SELECT * FROM book b
                INNER JOIN person_book pbk ON pbk.bookId = b.bookId
                INNER JOIN person po ON po.personId = pbk.ownerId
                INNER JOIN agenda a ON a.personId = pbk.keeperId
                INNER JOIN pet pt ON pt.petId = pbk.petId
                WHERE pbk.bookId = '$bookId';";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDate($value['startDate']);
        $book->setEndDate($value['endDate']);
        $book->setState($value['state']);

        $schedule = new Schedule();
        $schedule->setScheduleId($value['scheduleId']);
        $schedule->setStartDate($value['startDate']);
        $schedule->setEndDate($value['endDate']);
        $schedule->setState($value['state']);
        $schedule->setPersonId($value['personId']);
        $schedule->setSize($value['size']);
        $schedule->setPet_type($value['pet_type']);
        $schedule->setCost($value['cost']);
       
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setEmail($value['email']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);

        $pet = new Pet();
        $pet->setPetId($value['petId']);
        $pet->setPetname($value['petname']);
        $pet->setSize($value['size']);
        $pet->setPet_type($value['pet_type']);
        $pet->setBreed($value['breed']);

        array_push($bookList, $book, $schedule, $person, $pet);
      }

      return $bookList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

}

?>
