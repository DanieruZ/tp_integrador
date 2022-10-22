<?php

namespace Controllers;

use DAO\ScheduleDAO as ScheduleDAO;
use Models\Schedule as Schedule;
use Utils\Utils as Utils;

class ScheduleController
{

  private $scheduleDAO;

  public function __construct() {
    $this->scheduleDAO = new ScheduleDAO();
  }

  public function ScheduleView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-schedule.php");
  }

  public function AddSchedule($startDate, $endDate) {    
    $schedule = new Schedule();
    if ($schedule) {
      $schedule = new Schedule();
      $schedule->setStartDate($startDate);
      $schedule->setEndDate($endDate);

      $user = $_SESSION['keeper'];
      [$person] = $user;
      $personId = $person->getPersonId();

      $this->scheduleDAO->addSchedule($personId,$schedule);
      $this->ScheduleView();  

    }
  }

  public function logout() {
    session_destroy();
    header('location: ../index.php');
  }

}

?>