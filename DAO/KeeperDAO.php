<?php

namespace DAO;

use Models\Person as Person;
use DAO\IKeeperDAO as IKeeperDAO;
use DAO\Connection as Connection;
use Models\Schedule;

class KeeperDAO implements IKeeperDAO {

  private $keeperList = array();
  private $connection;

  public function addKeeper(Person $person) {
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

  //* Lista todos los keepers activos.
  public function getAllKeeper() {
    try {
      $keeperList = array();

      $query = "SELECT * FROM person p
                INNER JOIN rol r ON r.rolId = p.rolId
                WHERE r.rol = 'keeper' AND p.isActive = 1;";

      $this->connection = Connection::GetInstance();
      $allKeeper = $this->connection->Execute($query);

      foreach ($allKeeper as $value) {
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setEmail($value['email']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);

        array_push($keeperList, $person);
      }

      return $keeperList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

   public function getKeeperById($personId) {
    try {
      $keeperList = array();    

      $query = "SELECT * FROM person p
                INNER JOIN rol r ON r.rolId = p.rolId
                INNER JOIN agenda a ON a.personId = p.personId 
                WHERE r.rol = 'keeper' AND p.personId = '$personId' AND p.isActive = 1 AND a.state = 1;";

      $this->connection = Connection::GetInstance();
      $allKeeper = $this->connection->Execute($query);

      foreach ($allKeeper as $value) {
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setEmail($value['email']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);
        

       
        array_push($keeperList, $person);
      }

      return $keeperList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

    //* Activa el estado de un Keeper
    public function deleteKeeper() {
      try {
        $personList = array();

        $user = $_SESSION['keeper'];
        [$person] = $user;
        $personId = $person->getPersonId();
  
        $query = "UPDATE person
                  SET isActive = 0 
                  WHERE personId = '$personId';";
  
        $this->connection = Connection::GetInstance();
        $allPerson = $this->connection->Execute($query);
  
        foreach ($allPerson as $value) {
          $person = new Person();
          $person->setIsActive($value['isActive']);
  
          array_push($personList, $person);
        }
  
        return $personList;

      } catch (\PDOException $ex) {
          throw $ex;
        }
    }
  
    //* Activa el estado de un Keeper sin agenda o agenda eliminada.
    public function activeKeeper() {
      try {
        $personList = array();

        $user = $_SESSION['keeper'];
        [$person] = $user;
        $personId = $person->getPersonId();
  
        $query = "UPDATE person
                  SET isActive = 1 
                  WHERE personId = '$personId';";
  
        $this->connection = Connection::GetInstance();
        $allPerson = $this->connection->Execute($query);
  
        foreach ($allPerson as $value) {
          $person = new Person();
          $person->setIsActive($value['isActive']);
  
          array_push($personList, $person);
        }
  
        return $personList;

      } catch (\PDOException $ex) {
          throw $ex;
        }
    }

}

?>