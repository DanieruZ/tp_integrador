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

}

?>  