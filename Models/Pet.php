<?php

namespace Models;

class Pet {

  private $petId;
  private $petname;
  private $size;
  private $pet_type;
  private $breed;

  public function __construct() {}

  /**
   * Get the value of petId
   */ 
  public function getPetId()
  {
    return $this->petId;
  }

  /**
   * Set the value of petId
   *
   * @return  self
   */ 
  public function setPetId($petId)
  {
    $this->petId = $petId;

    return $this;
  }

  /**
   * Get the value of petname
   */ 
  public function getPetname()
  {
    return $this->petname;
  }

  /**
   * Set the value of petname
   *
   * @return  self
   */ 
  public function setPetname($petname)
  {
    $this->petname = $petname;

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
   * Get the value of breed
   */ 
  public function getBreed()
  {
    return $this->breed;
  }

  /**
   * Set the value of breed
   *
   * @return  self
   */ 
  public function setBreed($breed)
  {
    $this->breed = $breed;

    return $this;
  }
}

?>