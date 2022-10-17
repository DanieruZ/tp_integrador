<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\Person as Person;
use Utils\Utils as Utils;

class UserController {

  private $userDAO;
  
  public function __construct() {
    $this->userDAO = new UserDAO();
  }

  public function WelcomeView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-welcome.php");
  }

  public function AddView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-add.php");
  }

  public function ListView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function getUserByEmail($email){
    $user = $this->UserDAO->getUserByEmail($email);
    return $user;
  }

}

?>