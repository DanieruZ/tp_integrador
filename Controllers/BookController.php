<?php

namespace Controllers;

use DAO\BookDAO as BookDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use Models\Book as Book;
use Utils\Utils as Utils;

class BookController
{

  private $bookDAO;

  public function __construct()
  {
    $this->bookDAO = new BookDAO();
    $this->scheduleDAO = new ScheduleDAO();
  }

  public function OwnerView()
  {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-book.php");
  }

  public function KeeperView()
  {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-book.php");
  }

  public function PaymentOwner($bookId)
  {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "bill.php");
  }

  public function OwnerReserve($personId, $startDate, $endDate, $petId)
  {
    //Utils::checkOwnerSession();      
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-book-detail.php");
  }

  public function OwnerViewBookInfo($bookId)
  {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-reserve-info.php");
  }

  public function KeeperViewBookInfo($bookId)
  {
    //Utils::checkKeeperSession();
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

  public function GetBookInfoKeeper($bookId) {
    //Utils::checkKeeperSession();  
    $this->bookDAO->getBookInfoKeeper($bookId);
    $this->KeeperViewBookInfo($bookId);
  }

  public function GetBookInfoOwner($bookId) {
    //Utils::checkOwnerSession();  
    $this->bookDAO->getBookInfoOwner($bookId);
    $this->OwnerViewBookInfo($bookId);
  }
}

?>
