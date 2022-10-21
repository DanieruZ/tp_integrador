<?php

namespace Models;

class Person {

  private $personId;
  private $firstname;
  private $lastname;
  private $dni;
  private $email;
  private $pass;
  private $gender;
  private $isActive;
  private $rolId;
  private $scheduleId;

  public function __construct() {}


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
   * Get the value of firstname
   */ 
  public function getFirstname()
  {
    return $this->firstname;
  }

  /**
   * Set the value of firstname
   *
   * @return  self
   */ 
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;

    return $this;
  }

  /**
   * Get the value of lastname
   */ 
  public function getLastname()
  {
    return $this->lastname;
  }

  /**
   * Set the value of lastname
   *
   * @return  self
   */ 
  public function setLastname($lastname)
  {
    $this->lastname = $lastname;

    return $this;
  }

  /**
   * Get the value of dni
   */ 
  public function getDni()
  {
    return $this->dni;
  }

  /**
   * Set the value of dni
   *
   * @return  self
   */ 
  public function setDni($dni)
  {
    $this->dni = $dni;

    return $this;
  }

  /**
   * Get the value of email
   */ 
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */ 
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of pass
   */ 
  public function getPass()
  {
    return $this->pass;
  }

  /**
   * Set the value of pass
   *
   * @return  self
   */ 
  public function setPass($pass)
  {
    $this->pass = $pass;

    return $this;
  }

  /**
   * Get the value of gender
   */ 
  public function getGender()
  {
    return $this->gender;
  }

  /**
   * Set the value of gender
   *
   * @return  self
   */ 
  public function setGender($gender)
  {
    $this->gender = $gender;

    return $this;
  }

  /**
   * Get the value of isActive
   */ 
  public function getIsActive()
  {
    return $this->isActive;
  }

  /**
   * Set the value of isActive
   *
   * @return  self
   */ 
  public function setIsActive($isActive)
  {
    $this->isActive = $isActive;

    return $this;
  }

  /**
   * Get the value of rolId
   */ 
  public function getRolId()
  {
    return $this->rolId;
  }

  /**
   * Set the value of rolId
   *
   * @return  self
   */ 
  public function setRolId($rolId)
  {
    $this->rolId = $rolId;

    return $this;
  }

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
}

?>