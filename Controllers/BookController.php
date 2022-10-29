<?php

namespace Controllers;

use DAO\BookDAO;
use Models\Book as Book;
use Utils\Utils as Utils;

class BookController {

  private $bookDAO;

  public function __construct() {
    $this->bookDAO = new BookDAO();
  }

  public function OwnerView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-book.php");
  }

  public function KeeperView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-book.php");
  }

  public function OwnerReserve($personId, $startDate, $endDate,$petId) {
    //Utils::checkOwnerSession();      
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-book-detail.php");
  }

  public function OwnerViewBookInfo() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-reserve-info.php");
  }

  public function AddBook($startDate, $endDate, $keeperId,$petId) {
    //Utils::checkOwnerSession();  
      $book = new Book();   
   
    if ($book) {            
      $book = new Book();
      $book->setStartDate($startDate);
      $book->setEndDate($endDate);
      $book->setState(0);
    

      $this->bookDAO->addBook($book);
      $this->bookDAO->addPersonBook($keeperId,$petId);
      $this->OwnerView();       
    }
  }

}

?>