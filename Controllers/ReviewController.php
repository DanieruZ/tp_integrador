<?php

namespace Controllers;

use DAO\ReviewDAO as ReviewDAO;
use Models\Review as Review;
use Utils\Utils as Utils;

class ReviewController {

  private $reviewDAO;
  
  public function __construct() {
    $this->reviewDAO = new ReviewDAO();
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

  public function OwnerAddView($personId) {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-add-review.php");
  }

  public function AddReview($title, $message, $rate, $personId) {
    //Utils::checkOwnerSession();    
    $review = new Review();   

    if ($review) {            
      $review = new Review();
      $review->setTitle($title);
      $review->setMessage($message);
      $review->setRate($rate);
      $review->setPersonId($personId);

      $this->reviewDAO->addReview($review);
      $this->OwnerView();       
    }
  }
 
}

?>