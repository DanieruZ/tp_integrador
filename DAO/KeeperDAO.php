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
                INNER JOIN agenda a ON a.personId = p.personId 
                WHERE r.rol = 'keeper' AND p.isActive = 1 AND a.state = 1;";

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



}

?>
