<?php

namespace Models;

class Schedule {

  private $scheduleId;
  private $startDate;
  private $endDate;
  private $personId;

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