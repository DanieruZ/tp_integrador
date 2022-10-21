<?php

namespace DAO;

use Models\Person as Person;
use Models\User as User;
use DAO\IOwnerDAO as IOwnerDAO;
use DAO\Connection as Connection;

class OwnerDAO implements IOwnerDAO {

  private $ownerList = array();
  private $connection;

  public function addOwner(Person $person) {
    try {
      $query = "INSERT INTO person (firstname, lastname, dni, email, gender, isActive, rolId) 
                VALUES (:firstname, :lastname, :dni, :email, :gender, :isActive, :rolId)";
      
      $parameters['firstname'] = $person->getFirstname();
      $parameters['lastname'] = $person->getLastname();
      $parameters['dni'] = $person->getDni();
      $parameters['email'] = $person->getEmail();     
      $parameters['gender'] = $person->getGender();
      $parameters['isActive'] = $person->getIsActive();
      $parameters['rolId'] = $person->getRolId();    

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getAllOwner() {
    try {
      $ownerList = array();

      $query = "SELECT * FROM person p
                INNER JOIN rol r ON r.rolId = p.rolId
                WHERE r.rol = 'owner';";

      $this->connection = Connection::GetInstance();
      $allOwner = $this->connection->Execute($query);

      foreach ($allOwner as $value) {
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setEmail($value['email']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);

        array_push($ownerList, $person);
      }
      return $ownerList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getOwnerByEmail($email) {
    try {
      $ownerList = array();

      $query = "SELECT * FROM person p
                INNER JOIN rol r ON r.rolId = p.rolId
                WHERE email = '$email' AND r.rol = 'owner';";

      $this->connection = Connection::GetInstance();
      $allOwner = $this->connection->Execute($query);

      foreach ($allOwner as $value) {
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setEmail($value['email']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);

        array_push($ownerList, $person);
      }
    
        return $ownerList;

    } catch (\PDOException $ex) {
        throw $ex;
      }

  }

}

?>