<?php

namespace DAO;

use Models\Book as Book;
use Models\Person as Person;
use Models\Schedule as Schedule;
use Models\Pet as Pet;
use DAO\IBookDAO as IBookDAO;
use DAO\Connection as Connection;

class BookDAO implements IBookDAO
{

  private $bookList = array();
  private $connection;

  public function addBook(Book $book)
  {
    try {

      $query = "INSERT INTO book (startDateBook, endDateBook, stateBook, statePayment, stateReview, personId) 
                VALUES (:startDateBook, :endDateBook, :stateBook, :statePayment, :stateReview, :personId);";

      $parameters['startDateBook'] = $book->getStartDateBook();
      $parameters['endDateBook'] = $book->getEndDateBook();
      $parameters['stateBook'] = $book->getStateBook();
      $parameters['statePayment'] = $book->getStatePayment();
      $parameters['stateReview'] = $book->getStateReview();
      $parameters['personId'] = $book->getPersonId();
 
      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);
      
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  //* Setea un estado a la reserva.
  public function bookReserve($bookId, $stateValue) {
    try {
    
      $bookList = array();

      $query = "UPDATE book 
                SET stateBook = '$stateValue'                
                WHERE bookId = '$bookId';";

      $this->connection = Connection::GetInstance();    
      $allBook = $this->connection->Execute($query);    

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setStateBook($value['stateBook']);

        array_push($bookList, $book);
      }

      return $bookList;
    
    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Activa el estado del pago de la reserva.
  public function bookReservePayment($bookId) {
    try {
      $bookList = array();

      $query = "UPDATE book 
                SET statePayment = 1               
                WHERE bookId = '$bookId';";

      $this->connection = Connection::GetInstance();    
      $allBook = $this->connection->Execute($query);    

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setStatePayment($value['statePayment']);

        array_push($bookList, $book);
      }

      return $bookList;
    
    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Activa el estado de la review.
  public function bookReview($bookId) {
    try {
    
      $bookList = array();

      $query = "UPDATE book 
                SET stateReview = 1               
                WHERE bookId = '$bookId';";

      $this->connection = Connection::GetInstance();    
      $allBook = $this->connection->Execute($query);    

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setStateReview($value['stateReview']);

        array_push($bookList, $book);
      }

      return $bookList;
    
    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Lista todas las reservas.
  public function getAllBook()
  {
    try {

      $bookList = array();

      $query = "SELECT * FROM book;";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDateBook($value['startDateBook']);
        $book->setEndDateBook($value['endDateBook']);
        $book->setStateBook($value['stateBook']);
        $book->setStatePayment($value['statePayment']);
        $book->setStateReview($value['stateReview']);
        $book->setPersonId($value['personId']);

        array_push($bookList, $book);
      }

      return $bookList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  //* Lista todas las reservas activas.
  public function getActiveBook()
  {
    try {
      $bookList = array();

      $query = "SELECT * FROM book
                WHERE state = 1;";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDateBook($value['startDateBook']);
        $book->setEndDateBook($value['endDateBook']);
        $book->setStateBook($value['stateBook']);
        $book->setStatePayment($value['statePayment']);
        $book->setStateReview($value['stateReview']);
        $book->setPersonId($value['personId']);

        array_push($bookList, $book);
      }

      return $bookList;

    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  //* Trae el ultimo id de reservas.
  public function getBookLastId()
  {
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
  public function addPersonBook($petId)
  {
    try {
      $user = $_SESSION['owner'];
      [$person] = $user;
      $ownerId = $person->getPersonId();

      $lastId = $this->getBookLastId();
      [$book] = $lastId;
      $bookId = $book[0];

      $query = "INSERT INTO person_book (ownerId, petId, bookId)
                VALUES (:ownerId, :petId, :bookId);";

      $parameters['ownerId'] = $ownerId;
      $parameters['petId'] = $petId;
      $parameters['bookId'] = $bookId;

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  //* Lista todas las reservas de un owner.
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
        $book->setStartDateBook($value['startDateBook']);
        $book->setEndDateBook($value['endDateBook']);
        $book->setStateBook($value['stateBook']);
        $book->setStatePayment($value['statePayment']);
        $book->setStateReview($value['stateReview']);
        $book->setPersonId($value['personId']);

        array_push($bookList, $book);
      }

      return $bookList;

    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  //* Lista todas las reservas de un keeper.
  public function getKeeperBook($personId)
  {
    try {
      $bookList = array();

      $query = "SELECT * FROM book b
                INNER JOIN person_book bk ON bk.bookId = b.bookId
                WHERE b.personId = '$personId';";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDateBook($value['startDateBook']);
        $book->setEndDateBook($value['endDateBook']);
        $book->setStateBook($value['stateBook']);
        $book->setStatePayment($value['statePayment']);
        $book->setStateReview($value['stateReview']);
        $book->setPersonId($value['personId']);

        array_push($bookList, $book);
      }

      return $bookList;

    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  //* Lista toda la info de un owner.
  public function getBookInfoOwner($bookId)
  {
    try {
      $bookList = array();

      $query = "SELECT * FROM book b
                INNER JOIN person_book pbk ON pbk.bookId = b.bookId
                INNER JOIN person p ON p.personId = b.personId
                INNER JOIN pet pt ON pt.petId = pbk.petId
                INNER JOIN agenda a ON a.personId = b.personId
                WHERE pbk.bookId = '$bookId';";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDateBook($value['startDateBook']);
        $book->setEndDateBook($value['endDateBook']);
        $book->setStateBook($value['stateBook']);
        $book->setStatePayment($value['statePayment']);
        $book->setStateReview($value['stateReview']);
        $book->setPersonId($value['personId']);

        $schedule = new Schedule();
        $schedule->setCost($value['cost']);
        $schedule->setScheduleId($value['scheduleId']);
        $schedule->setStartDate($value['startDate']);
        $schedule->setEndDate($value['endDate']);
        $schedule->setState($value['state']);
        $schedule->setPersonId($value['personId']);
        $schedule->setSize($value['size']);
        $schedule->setPet_type($value['pet_type']);

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

  //* Lista toda la info de un keeper.
  public function getBookInfoKeeper($bookId)
  {
    try {
      $bookList = array();

      $query = "SELECT * FROM book b
                INNER JOIN person_book pbk ON pbk.bookId = b.bookId
                INNER JOIN person p ON p.personId = pbk.ownerId
                INNER JOIN agenda a ON a.personId = b.personId
                INNER JOIN pet pt ON pt.petId = pbk.petId
                WHERE pbk.bookId = '$bookId';";

      $this->connection = Connection::GetInstance();
      $allBook = $this->connection->Execute($query);

      foreach ($allBook as $value) {
        $book = new Book();
        $book->setBookId($value['bookId']);
        $book->setStartDateBook($value['startDateBook']);
        $book->setEndDateBook($value['endDateBook']);
        $book->setStateBook($value['stateBook']);
        $book->setStatePayment($value['statePayment']);
        $book->setStateReview($value['stateReview']);
        $book->setPersonId($value['personId']);

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