<?php

namespace Controllers;

use DAO\BookDAO as BookDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\KeeperDAO as KeeperDAO;
use DAO\PetDAO as PetDAO;
use Models\Book as Book;
use Utils\Utils as Utils;
use DateTime;

class BookController
{

  private $bookDAO;

  public function __construct()
  {
    $this->bookDAO = new BookDAO();
    $this->scheduleDAO = new ScheduleDAO();
    $this->keeperDAO = new KeeperDAO();
    $this->petDAO = new PetDAO();
  }

  public function OwnerView()
  {
    //Utils::checkOwnerSession();

    $review = [];
    $user = $_SESSION['owner'];
    [$owner] = $user;
    $bookList = $this->bookDAO->getOwnerBook($owner->getPersonId());
    [$book] = $bookList;
    $bookInfo = $this->bookDAO->getBookInfoOwner($book->getBookId());
    [$book, $schedule, $person, $pet] = $bookInfo;
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-book.php");
  }

  public function KeeperView()
  {
    //Utils::checkKeeperSession();
    $user = $_SESSION['keeper'];
    [$person] = $user;
    $bookList = $this->bookDAO->getKeeperBook($person->getPersonId());
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-book.php");
  }

  public function PaymentOwner($bookId)
  {
    //Utils::checkKeeperSession(); 

    $user = $_SESSION['owner'];
    [$owner] = $user;
    $bookInfo =  $this->bookDAO->getBookInfoOwner($bookId);
    [$book, $schedule, $person, $pet] = $bookInfo;
    $startDate = $book->getStartDateBook();
    $endDate = $book->getEndDateBook();
    $fecha1 = new DateTime($startDate);
    $fecha2 = new DateTime($endDate);
    $diff = $fecha1->diff($fecha2);
    $dias = 1 + $diff->days;
    $totalCost = $schedule->getCost() * $dias + $schedule->getCost() * $dias * 0.31;
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "bill.php");
  }

  public function OwnerReserve($personId, $startDate, $endDate, $petId)
  {
    //Utils::checkOwnerSession();  

    $petInfo =  $this->petDAO->getPetById($petId);
    [$pet] = $petInfo;

    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $keeperInfo = $this->keeperDAO->getKeeperById($personId);
    [$keeper] = $keeperInfo;

    $scheduleInfo = $this->scheduleDAO->getScheduleById($personId);
    [$schedule] = $scheduleInfo;

    $fecha1 = new DateTime($startDate);
    $fecha2 = new DateTime($endDate);
    $diff = $fecha1->diff($fecha2);
    $dias = 1 + $diff->days;
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-book-detail.php");
  }

  public function OwnerViewBookInfo($bookId)
  {
    //Utils::checkOwnerSession();

    $user = $_SESSION['owner'];
    [$owner] = $user;
    $booInfo =  $this->bookDAO->getBookInfoOwner($bookId);
    [$book, $schedule, $person, $pet] = $booInfo;
    $startDate = $book->getStartDateBook();
    $endDate = $book->getEndDateBook();
    $fecha1 = new DateTime($startDate);
    $fecha2 = new DateTime($endDate);
    $diff = $fecha1->diff($fecha2);
    $dias = 1 + $diff->days;
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-reserve-info.php");
  }

  public function KeeperViewBookInfo($bookId)
  {
    //Utils::checkKeeperSession();
    $user = $_SESSION['keeper'];
    [$keeper] = $user;

    $booInfo =  $this->bookDAO->getBookInfoKeeper($bookId);
    [$book, $schedule, $person, $pet] = $booInfo;

    $startDate = $book->getStartDateBook();
    $endDate = $book->getEndDateBook();
    $fecha1 = new DateTime($startDate);
    $fecha2 = new DateTime($endDate);
    $diff = $fecha1->diff($fecha2);
    $dias = 1 + $diff->days;
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-reserve-info.php");
  }

  public function KeeperSendInfoReserve($bookId, $stateValue, $scheduleId, $endDateBook)
  {
    //Utils::checkOwnerSession();


    $this->bookDAO->bookReserve($bookId, $stateValue);
    $this->scheduleDAO->scheduleReserve($scheduleId, $endDateBook);
    $this->KeeperView();
    //}
  }

  public function PaymentReserve($bookId)
  {
    //Utils::checkOwnerSession();    

    $this->PaymentOwner($bookId);
  }

  public function Payment($bookId)
  {
    //Utils::checkOwnerSession();
    $this->bookDAO->bookReservePayment($bookId);
    $this->OwnerView();
  }


  public function AddBook($startDate, $endDate, $personId, $petId)
  {
    //Utils::checkOwnerSession();  

    $book = new Book();

    if ($book) {
      $book = new Book();
      $book->setStartDateBook($startDate);
      $book->setEndDateBook($endDate);
      $book->setStateBook(0);
      $book->setStatePayment(0);
      $book->setStateReview(0);
      $book->setPersonId($personId);

      $this->bookDAO->addBook($book);
      $this->bookDAO->addPersonBook($petId);
      $this->OwnerView();
    }
  }

  public function GetBookInfoKeeper($bookId)
  {
    //Utils::checkKeeperSession();  
    $this->bookDAO->getBookInfoKeeper($bookId);
    $this->KeeperViewBookInfo($bookId);
  }

  public function GetBookInfoOwner($bookId)
  {
    //Utils::checkOwnerSession();  
    $this->bookDAO->getBookInfoOwner($bookId);
    $this->OwnerViewBookInfo($bookId);
  }
}
