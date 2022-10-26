<?php

namespace Models;

class Book {

  private $bookId;
  private $startDate;
  private $endDate;
  private $state;

  public function __construct() {}


  /**
   * Get the value of bookId
   */ 
  public function getBookId()
  {
    return $this->bookId;
  }

  /**
   * Set the value of bookId
   *
   * @return  self
   */ 
  public function setBookId($bookId)
  {
    $this->bookId = $bookId;

    return $this;
  }

  /**
   * Get the value of startDate
   */ 
  public function getStartDate()
  {
    return $this->startDate;
  }

  /**
   * Set the value of startDate
   *
   * @return  self
   */ 
  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;

    return $this;
  }

  /**
   * Get the value of endDate
   */ 
  public function getEndDate()
  {
    return $this->endDate;
  }

  /**
   * Set the value of endDate
   *
   * @return  self
   */ 
  public function setEndDate($endDate)
  {
    $this->endDate = $endDate;

    return $this;
  }

  /**
   * Get the value of state
   */ 
  public function getState()
  {
    return $this->state;
  }

  /**
   * Set the value of state
   *
   * @return  self
   */ 
  public function setState($state)
  {
    $this->state = $state;

    return $this;
  }
  
}

?>