<?php

namespace Models;

class Rol {

  private $rolId;
  private $rol;

  public function __construct() {}

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
   * Get the value of rol
   */ 
  public function getRol()
  {
    return $this->rol;
  }

  /**
   * Set the value of rol
   *
   * @return  self
   */ 
  public function setRol($rol)
  {
    $this->rol = $rol;

    return $this;
  }
}

?>