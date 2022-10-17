<?php

namespace Controllers;

use Models\Person as Person;
use DAO\UserDAO as UserDAO;

class LoginController {

  private $userDAO;

  public function __construct() {
    $this->userDAO = new UserDAO();
  }
  
  public function login($email) {
    $user = $this->userDAO->getUserByEmail($email); 
    [$u] = $user;
    $rolId = $u->getRolId();  

    if($user) {
      if($rolId == 1) {
        $_SESSION['admin'] = $user;
        require_once(VIEWS_PATH . "admin-welcome.php");
      }

      if($rolId == 2) {
        $_SESSION['owner'] = $user;
        require_once(VIEWS_PATH . "owner-welcome.php");
      }

      if($rolId == 3) {
        $_SESSION['keeper'] = $user;
        require_once(VIEWS_PATH . "keeper-welcome.php");
      }
    }
  }

  public function logout() {
    session_destroy();
    header('location: ../index.php');
  }

}

?>
