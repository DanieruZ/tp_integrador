<?php

namespace DAO;

use Models\Pet as Pet;
use DAO\IPetDAO as IPetDAO;
use DAO\Connection as Connection;

class PetDAO implements IPetDAO {

  private $petList = array();
  private $connection;

  public function addPet(Pet $pet) {
    try {
      $query = "INSERT INTO pet (petname, size, pet_type, breed)
                VALUES (:petname, :size, :pet_type, :breed)";
                
      $parameters['petname'] = $pet->getPetname();
      $parameters['size'] = $pet->getSize();
      $parameters['pet_type'] = $pet->getPet_type();
      $parameters['breed'] = $pet->getBreed();   

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getPetLastId() {
    try {
      $query = "SELECT MAX(petId) FROM pet;"; 

      $this->connection = Connection::GetInstance();
      $petId = $this->connection->Execute($query);
      
      return $petId;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function addPetOwner($personId, $petId) {
    try {
      $query = "INSERT INTO pet_owner (personId, petId)
                VALUES (:personId, :petId);";
                
      $parameters['petId'] = $petId;
      $parameters['personId'] = $personId;  

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }



  public function getAllPet() {
    try {
      $petList = array();

      $query = "SELECT * FROM pet;";

      $this->connection = Connection::GetInstance();
      $allPet = $this->connection->Execute($query);

      foreach ($allPet as $value) {
        $pet = new Pet();
        $pet->setPetId($value['petId']);
        $pet->setPetname($value['petname']);
        $pet->setSize($value['size']);
        $pet->setPet_type($value['pet_type']);
        $pet->setBreed($value['breed']);
        
        array_push($petList, $pet);

      }
      
      return $petList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getMyPet($personId) {
    try {
      $petList = array();

      $query = "SELECT * FROM pet pt
                INNER JOIN pet_owner po ON po.petId = pt.petId
                INNER JOIN person p ON p.personId = po.personId
                WHERE p.personId = '$personId';";

      $this->connection = Connection::GetInstance();
      $allPet = $this->connection->Execute($query);

      foreach ($allPet as $value) {
        $pet = new Pet();
        $pet->setPetId($value['petId']);
        $pet->setPetname($value['petname']);
        $pet->setSize($value['size']);
        $pet->setPet_type($value['pet_type']);
        $pet->setBreed($value['breed']);
        
        array_push($petList, $pet);
      }
      
      return $petList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

}

?>