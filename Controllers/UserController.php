<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\Person as Person;
use Utils\Utils as Utils;

class UserController
{

  private $userDAO;

  public function __construct() {
    $this->userDAO = new UserDAO();
  }

  public function RegisterView() {
    require_once(VIEWS_PATH . "user-register.php");
  }

  public function AddUser($firstname, $lastname, $dni, $email, $gender,$rolId) {    
    $user = new Person();
    if ($user) {
      $user = new Person();
      $user->setFirstname($firstname);
      $user->setLastname($lastname);
      $user->setDni($dni);
      $user->setEmail($email);
      $user->setGender($gender);
      $user->setIsActive(1);
      $user->setRolId($rolId);
      $this->userDAO->addUser($user);
      header('location: ../index.php');
    }
  }

  public function logout() {
    session_destroy();
    header('location: ../index.php');
  }

}

?>
