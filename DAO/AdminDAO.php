<?php

namespace DAO;

use Models\Person;
use DAO\IAdminDAO as IAdminDAO;
use DAO\Connection as Connection;

class AdminDAO implements IAdminDAO {

  private $connection;

  public function getAllAdmin() {
    try {
      $adminList = array();

      $query = "SELECT * FROM person p
                INNER JOIN rol r ON r.rolId = p.rolId
                WHERE r.rol = 'admin';";

      $this->connection = Connection::GetInstance();
      $allAdmin = $this->connection->Execute($query);

      foreach ($allAdmin as $value) {
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setEmail($value['email']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);

        array_push($userList, $person);
      }
    
        return $userList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
 }
 
}

?>