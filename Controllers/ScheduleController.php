<?php

namespace Controllers;

use DAO\ScheduleDAO as ScheduleDAO;
use DAO\KeeperDAO as KeeperDAO;
use Models\Schedule as Schedule;
use Models\Person as Person;
use Utils\Utils as Utils;

class ScheduleController {

  private $scheduleDAO;

  public function __construct() {
    $this->scheduleDAO = new ScheduleDAO();
    $this->keeperDAO = new KeeperDAO();
  }

  public function ScheduleView() {
    //Utils::checkKeeperSession();+
    
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-schedule.php");
  }

  public function AddSchedule($startDate, $endDate,$size, $pet_type,$cost) {    
    $schedule = new Schedule();
    $person = new Person();    
  

    if ($schedule && $person) {
      $schedule = new Schedule();
      $schedule->setStartDate($startDate);
      $schedule->setEndDate($endDate);   
      $schedule->setState(1);  
      $person->setIsActive(1);
      $schedule->setSize($size);
      $schedule->setPet_type($pet_type);
      $schedule->setCost($cost);

      $this->scheduleDAO->addSchedule($schedule);
      $this->keeperDAO->activeKeeper($person);
      $this->ScheduleView();  
    }
  }

  public function DeleteSchedule() {    
    $schedule = new Schedule();
    $person = new Person();

    if ($schedule && $person) {
      $schedule = new Schedule();  
      $person = new Person();    
      $schedule->setState(0);
      $person->setIsActive(0);

      $this->scheduleDAO->deleteSchedule($schedule);
      $this->keeperDAO->deleteKeeper($person);      
      $this->ScheduleView();  
    }

  }

  public function logout() {
    session_destroy();
    header('location: ../index.php');
  }

}

?>