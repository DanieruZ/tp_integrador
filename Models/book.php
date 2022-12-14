<?php

namespace Models;

class Book {

  private $bookId;
  private $startDateBook;
  private $endDateBook;
  private $stateBook;
  private $statePayment;
 

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
   * Get the value of startDateBook
   */ 
  public function getStartDateBook()
  {
    return $this->startDateBook;
  }

  /**
   * Set the value of startDateBook
   *
   * @return  self
   */ 
  public function setStartDateBook($startDateBook)
  {
    $this->startDateBook = $startDateBook;

    return $this;
  }

  /**
   * Get the value of endDateBook
   */ 
  public function getEndDateBook()
  {
    return $this->endDateBook;
  }

  /**
   * Set the value of endDateBook
   *
   * @return  self
   */ 
  public function setEndDateBook($endDateBook)
  {
    $this->endDateBook = $endDateBook;

    return $this;
  }

  /**
   * Get the value of stateBook
   */ 
  public function getStateBook()
  {
    return $this->stateBook;
  }

  /**
   * Set the value of stateBook
   *
   * @return  self
   */ 
  public function setStateBook($stateBook)
  {
    $this->stateBook = $stateBook;

    return $this;
  }

  /**
   * Get the value of statePayment
   */ 
  public function getStatePayment()
  {
    return $this->statePayment;
  }

  /**
   * Set the value of statePayment
   *
   * @return  self
   */ 
  public function setStatePayment($statePayment)
  {
    $this->statePayment = $statePayment;

    return $this;
  }
}

?>