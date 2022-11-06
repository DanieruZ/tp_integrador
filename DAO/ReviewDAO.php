<?php

namespace DAO;

use Models\Review as Review;
use DAO\IReviewDAO as IReviewDAO;
use DAO\Connection as Connection;

class ReviewDAO implements IReviewDAO {

  private $reviewList = array();
  private $connection;

  public function addReview(Review $review) {
    try {
      
      $query = "INSERT INTO review (title, message, rate, personId)
                VALUES (:title, :message, :rate, :personId)";
                
      $parameters['title'] = $review->getTitle();
      $parameters['message'] = $review->getMessage();
      $parameters['rate'] = $review->getRate();
      $parameters['personId'] = $review->getPersonId();   

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getReviewById($personId) {
    try {

      $reviewList = array();

      $query = "SELECT * FROM review
                WHERE personId = '$personId';";

      $this->connection = Connection::GetInstance();
      $allReview = $this->connection->Execute($query);

      foreach ($allReview as $value) {
        $review = new Review();
        $review->setReviewId($value['reviewId']);
        $review->setTitle($value['title']);
        $review->setMessage($value['message']);
        $review->setRate($value['rate']);
        $review->setPersonId($value['personId']);
        
        array_push($reviewList, $review);
      }
      
      return $reviewList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getRateById($personId) {
    try {
      $query = "SELECT AVG(rate) FROM review
                WHERE personId = '$personId';"; 

      $this->connection = Connection::GetInstance();
      $rate = $this->connection->Execute($query);
      
      return $rate;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

}

?>