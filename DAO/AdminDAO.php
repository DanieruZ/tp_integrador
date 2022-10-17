<?php

namespace DAO;

use Models\User as User;
use Models\Person;
use Models\Rol;
use DAO\IAdminDAO as IAdminDAO;
use DAO\Connection as Connection;

class AdminDAO implements IAdminDAO {

  private $connection;

  public function getAllAdmin() {
    try {
      $adminList = array();

      $query = "SELECT u.*, p.*, r.* FROM username u
                INNER JOIN person p ON p.personId = u.personId
                INNER JOIN rol r ON r.rolId = p.rolId
                WHERE r.rol = 'admin'";

      $this->connection = Connection::GetInstance();
      $allAdmin = $this->connection->Execute($query);

      foreach ($allAdmin as $value) {
        $person = new Person();
        $person->setPersonId($value['personId']);
        $person->setFirstname($value['firstname']);
        $person->setLastname($value['lastname']);
        $person->setDni($value['dni']);
        $person->setGender($value['gender']);
        $person->setIsActive($value['isActive']);
        $person->setRolId($value['rolId']);
        
        $user = new User();
        $user->setUserId($value['userId']);
        $user->setUsername($value['username']);
        $user->setEmail($value['email']);
        $user->setPass($value['pass']);
        $user->setPersonId($value['personId']);

        $rol = new Rol();
        $rol->setRolId($value['rolId']);
        $rol->setRol($value['rol']);

        array_push($userList, $person, $user, $rol);
      }
    
        return $userList;

    } catch (\PDOException $ex) {
        throw $ex;
      }
 }
 
}

?>