<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\Person as Person;
use Utils\Utils as Utils;

class UserController
{

  private $userDAO;

  public function __construct()
  {
    $this->userDAO = new UserDAO();
  }

  public function WelcomeView()
  {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-welcome.php");
  }

  public function AddView()
  {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-add.php");
  }

  public function ListView()
  {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function RegisterView()
  {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "useRegister.php");

  }

  public function AddPerson($firstname, $lastname, $dni, $email, $gender,$rolId)
  {
    //Utils::checkAdminSession();    
    $person = new Person();
    if ($person) {
      $person = new Person();
      $person->setFirstname($firstname);
      $person->setLastname($lastname);
      $person->setDni($dni);
      $person->setEmail($email);
      $person->setGender($gender);
      $person->setIsActive(1);
      $person->setRolId($rolId);
      $this->userDAO->addPerson($person);
      $this->ListView();
    }
  }
}
