<?php

namespace DAO;

use Models\Schedule;
use DAO\IScheduleDAO as IScheduleDAO;

use DAO\Connection as Connection;

class ScheduleDAO implements IScheduleDAO
{

  private $connection;

  public function addSchedule(Schedule $schedule)
  {
    try {
      $user = $_SESSION['keeper'];
      [$person] = $user;

      $query = "INSERT INTO agenda ( startDate, endDate, state, personId ) 
                VALUES (:startDate, :endDate, :state, :personId)";

      $parameters['startDate'] = $schedule->getStartDate();
      $parameters['endDate'] = $schedule->getEndDate();
      $parameters['state'] = $schedule->getState();
      $parameters['personId'] = $person->getPersonId();

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  public function getSchedule()
  {
    try {
      $scheduleList = array();

      $query = "SELECT * FROM agenda
                WHERE personId IS NOT NULL AND state = 1;";

      $this->connection = Connection::GetInstance();
      $allSchedule = $this->connection->Execute($query);

      foreach ($allSchedule as $value) {
        $schedule = new Schedule();
        $schedule->setScheduleId($value['scheduleId']);
        $schedule->setStartDate($value['startDate']);
        $schedule->setEndDate($value['endDate']);
        $schedule->setState($value['state']);
        $schedule->setPersonId($value['personId']);



        array_push($scheduleList, $schedule);
      }

      return $scheduleList;
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }


  public function getScheduleById()
  {
    try {
      $scheduleList = array();
      $user = $_SESSION['keeper'];
      [$person] = $user;
      $personId = $person->getPersonId();
      

      $query = "SELECT * FROM agenda a
                INNER JOIN person p ON p.personId = a.personId
                WHERE p.personId = '$personId' AND (SELECT MAX(a.scheduleId) FROM agenda) 
                order by a.scheduleId  desc;";

      $this->connection = Connection::GetInstance();
      $allSchedule = $this->connection->Execute($query);

      foreach ($allSchedule as $value) {
        $schedule = new Schedule();
        $schedule->setScheduleId($value['scheduleId']);
        $schedule->setStartDate($value['startDate']);
        $schedule->setState($value['state']);
        $schedule->setEndDate($value['endDate']);


        array_push($scheduleList, $schedule);
      }

      return $scheduleList;
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  public function deleteSchedule()
  {
    try {
      $scheduleList = array();
      $user = $_SESSION['keeper'];
      [$person] = $user;
      $personId = $person->getPersonId();

      $query = "UPDATE agenda
                SET state = 0 
                WHERE personId = '$personId' ;";

      $this->connection = Connection::GetInstance();
      $allSchedule = $this->connection->Execute($query);

      foreach ($allSchedule as $value) {
        $schedule = new Schedule();
        $schedule->setState($value['state']);

        array_push($scheduleList, $schedule);
      }

      return $scheduleList;
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }


}
