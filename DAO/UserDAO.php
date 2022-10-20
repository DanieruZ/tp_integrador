<?php

namespace DAO;

use Models\Person;
use DAO\IUserDAO as IUserDAO;
use DAO\Connection as Connection;

class UserDAO implements IUserDAO {

  private $connection;

  //* Lista todos los usuarios registrados.
  public function getAllUser() {
    try {
      $userList = array();

      $query = "SELECT * FROM person;";

      $this->connection = Connection::GetInstance();
      $allUser = $this->connection->Execute($query);

      foreach ($allUser as $value) {
        $user = new Person();
        $user->setPersonId($value['personId']);
        $user->setFirstname($value['firstname']);
        $user->setLastname($value['lastname']);
        $user->setDni($value['dni']);
        $user->setEmail($value['email']);
        $user->setPass($value['pass']);
        $user->setGender($value['gender']);
        $user->setIsActive($value['isActive']);
        $user->setRolId($value['rolId']);

        array_push($userList, $user);
      }
      
      return $userList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function getUserByEmail($email) {
    try {
      $userList = array();

      $query = "SELECT * FROM person
                WHERE email = '$email';";

      $this->connection = Connection::GetInstance();
      $allUser = $this->connection->Execute($query);

      foreach ($allUser as $value) {
        $user = new Person();
        $user->setPersonId($value['personId']);
        $user->setFirstname($value['firstname']);
        $user->setLastname($value['lastname']);
        $user->setDni($value['dni']);
        $user->setEmail($value['email']);
        $user->setPass($value['pass']);
        $user->setGender($value['gender']);
        $user->setIsActive($value['isActive']);
        $user->setRolId($value['rolId']);

        array_push($userList, $user);
      }

      return $userList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

  public function addPerson(Person $person) {
    try {
      $query = "INSERT INTO person (firstname, lastname, dni, email, gender, isActive, rolId) 
                VALUES (:firstname, :lastname, :dni, :email,  :gender, :isActive, :rolId)";
      
      $parameters['firstname'] = $person->getFirstname();
      $parameters['lastname'] = $person->getLastname();
      $parameters['dni'] = $person->getDni();
      $parameters['email'] = $person->getEmail();
      // $parameters['pass'] = $person->getPass();
      $parameters['gender'] = $person->getGender();
      $parameters['isActive'] = $person->getIsActive();
      $parameters['rolId'] = $person->getRolId();   

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }

}

?>  