<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\Person as Person;

class LoginController {

  private $userDAO;

  public function __construct() {
    $this->userDAO = new UserDAO();
  }

  public function getUserByEmail($email){
    $user = $this->UserDAO->getUserByEmail($email);
    return $user;
  }

  
  public function login(Person $user) {
   $user = $this->getUserByEmail($email);
   $user; 
   print_r($user);

   /* if($userList->getRolId() == 'admin') {
      $_SESSION['admin'] = $userList;
      require_once(VIEWS_PATH . "admin-welcome.php");
    }*/

    /*if($user->getRolId() == 'owner') {
      $_SESSION['owner'] = $user;
      require_once(VIEWS_PATH . "owner-welcome.php");
    }*/

    /*if($person->getRol() == 'keeper') {
      $_SESSION['keeper'] = $userList;
      require_once(VIEWS_PATH . "keeper-welcome.php");
    }*/
  }

  public function logout() {
    session_destroy();
    header('location: ../index.php');
  }

}

?>
