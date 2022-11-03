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

  public function ScheduleView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-schedule.php");
  }

  public function OwnerScheduleView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-owner-schedule.php");
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

  public function fecha ($fechaInicio,$fechaFin ) {
    //Utils::checkKeeperSession();  
    $person = new Person();  

    if ($person) {            
      $person = new Person();
      $person->setIsActive(1); 
      
      $user = $_SESSION['keeper'];
      [$person] = $user;     

      $this->keeperDAO->addKeeper($person);
      $this->ScheduleView();       
    }
    print_r($fechaInicio );
    echo("<br>");
    print_r($fechaFin );
   
   }

}

?>