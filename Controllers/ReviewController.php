<?php

namespace Controllers;

use DAO\ReviewDAO as ReviewDAO;
use DAO\BookDAO as BookDAO;
use Models\Review as Review;
use Utils\Utils as Utils;

class ReviewController {

  private $reviewDAO;
  
  public function __construct() {
    $this->reviewDAO = new ReviewDAO();
    $this->bookDAO = new BookDAO();
  }

  public function KeeperView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-review.php");
  }

  public function OwnerView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function OwnerAddView($personId,$bookId) {
    //Utils::checkOwnerSession();   
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-add-review.php");
  }

  public function AddReview($title, $message, $rate, $personId,$bookId) {
    //Utils::checkOwnerSession(); 
    

    $review = new Review(); 
    if ($review) {            
      $review = new Review();
      $review->setTitle($title);
      $review->setMessage($message);
      $review->setRate($rate);
      $review->setPersonId($personId);
      $this->reviewDAO->addReview($review);   
      $this->bookDAO->bookReview($bookId);   
      $this->OwnerView();       
    }
  }
 
}

?>