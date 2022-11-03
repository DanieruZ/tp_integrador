<?php

namespace Models;

class Review {

  private $reviewId;
  private $title;
  private $message;
  private $rate;
  private $personId;
  
  public function __construct() {}

  /**
   * Get the value of reviewId
   */ 
  public function getReviewId()
  {
    return $this->reviewId;
  }

  /**
   * Set the value of reviewId
   *
   * @return  self
   */ 
  public function setReviewId($reviewId)
  {
    $this->reviewId = $reviewId;

    return $this;
  }

  /**
   * Get the value of title
   */ 
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set the value of title
   *
   * @return  self
   */ 
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get the value of message
   */ 
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Set the value of message
   *
   * @return  self
   */ 
  public function setMessage($message)
  {
    $this->message = $message;

    return $this;
  }

  /**
   * Get the value of rate
   */ 
  public function getRate()
  {
    return $this->rate;
  }

  /**
   * Set the value of rate
   *
   * @return  self
   */ 
  public function setRate($rate)
  {
    $this->rate = $rate;

    return $this;
  }

  /**
   * Get the value of personId
   */ 
  public function getPersonId()
  {
    return $this->personId;
  }

  /**
   * Set the value of personId
   *
   * @return  self
   */ 
  public function setPersonId($personId)
  {
    $this->personId = $personId;

    return $this;
  }
  
}

?>