<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use Models\Person as Person;
use Utils\Utils as Utils;

class KeeperController {

  private $keeperDAO;
  
  public function __construct() {
    $this->keeperDAO = new KeeperDAO();
  }

  public function WelcomeView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-welcome.php");
  }

  public function AddView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-add.php");
  }

  public function ListView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function OwnerListView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function AdminListView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "admin-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function AddKeeper($firstname, $lastname, $dni,$email,$gender) {
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
      $person->setRolId(3);   
      $this->keeperDAO->addKeeper($person);
      $this->ListView();       
    }
  }

}
