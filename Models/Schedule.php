<?php

namespace Models;

class Schedule {

  private $scheduleId;
  private $startDate;
  private $endDate;
  private $state;
  private $personId;
  private $size;
  private $pet_type;
  private $cost;
  

  public function __construct() {}


  /**
   * Get the value of scheduleId
   */ 
  public function getScheduleId()
  {
    return $this->scheduleId;
  }

  /**
   * Set the value of scheduleId
   *
   * @return  self
   */ 
  public function setScheduleId($scheduleId)
  {
    $this->scheduleId = $scheduleId;

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

  /**
   * Get the value of size
   */ 
  public function getSize()
  {
    return $this->size;
  }

  /**
   * Set the value of size
   *
   * @return  self
   */ 
  public function setSize($size)
  {
    $this->size = $size;

    return $this;
  }



  /**
   * Get the value of pet_type
   */ 
  public function getPet_type()
  {
    return $this->pet_type;
  }

  /**
   * Set the value of pet_type
   *
   * @return  self
   */ 
  public function setPet_type($pet_type)
  {
    $this->pet_type = $pet_type;

    return $this;
  }

  /**
   * Get the value of cost
   */ 
  public function getCost()
  {
    return $this->cost;
  }

  /**
   * Set the value of cost
   *
   * @return  self
   */ 
  public function setCost($cost)
  {
    $this->cost = $cost;

    return $this;
  }
}

?>