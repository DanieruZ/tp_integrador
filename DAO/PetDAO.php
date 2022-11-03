<?php

namespace DAO;

use Models\Pet as Pet;
use Models\Person as Person;
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

  public function addPetOwner() {
    try {
      $user = $_SESSION['owner'];
      [$person] = $user;      
      $personId = $person->getPersonId();

      $lastId = $this->getPetLastId();
      [$pet] = $lastId;
      $petId = $pet[0];

      $query = "INSERT INTO pet_owner (personId, petId)
                VALUES (:personId, :petId);";
               
      $parameters['personId'] = $personId;          
      $parameters['petId'] = $petId;
       
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

  public function deletePetById($petId) {
    try {
      $query = "DELETE FROM pet WHERE petId = :petId;";

      $parameters['petId'] = $petId;

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getPetById($petId) {
    try {
      $petList = array();    

      $query = "SELECT * FROM pet
                WHERE petId = '$petId';";

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

  //funcion que nos trae el tipo de mascotas sin repetir
  public function getPetType() {
    try {
      $petList = array();    

      $query = "SELECT DISTINCT pet_type FROM pet;"; // traemos solo uno pet de cada tipo

      $this->connection = Connection::GetInstance();
      $allPet = $this->connection->Execute($query);

      foreach ($allPet as $value) {
        $pet = new Pet();       
        $pet->setPet_type($value['pet_type']);    
        
        array_push($petList, $pet);
      }

      return $petList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  /*public function updatePet($petId, $petname, $size, $pet_type, $breed) {
    try {
      $query = "UPDATE pet 
                SET petname = '$petname', 
                    size = '$size', 
                    pet_type = '$pet_type',
                    breed = '$breed'
                WHERE petId = '$petId';";
      $pet = new Pet();
      $parameters['petId'] = $pet->getPetId();
      $parameters['petname'] = $pet->getPetname();
      $parameters['size'] = $pet->getSize();
      $parameters['pet_type'] = $pet->getPet_type();
      $parameters['breed'] = $pet->getBreed(); 
      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);
    } catch (\PDOException $ex) {
        throw $ex;
      }
  }*/

  public function updatePet(Pet $pet) {
    try {
      $query = "UPDATE pet 
                SET petname = :petname, 
                    size = :size, 
                    pet_type = :pet_type,
                    breed = :breed,
                WHERE petId = :petId';";

      $parameters['petId'] = $pet->getPetId();
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

}

?>