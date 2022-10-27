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

      $query = "INSERT INTO agenda ( startDate, endDate, state, personId, size, pet_type, cost ) 
                VALUES (:startDate, :endDate, :state, :personId, :size, :pet_type, :cost)";

      $parameters['startDate'] = $schedule->getStartDate();
      $parameters['endDate'] = $schedule->getEndDate();
      $parameters['state'] = $schedule->getState();
      $parameters['personId'] = $person->getPersonId();
      $parameters['size'] = $schedule->getSize();
      $parameters['pet_type'] = $schedule->getPet_type();
      $parameters['cost'] = $schedule->getCost();

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
                WHERE personId IS NOT NULL 
                AND state = 1;";

      $this->connection = Connection::GetInstance();
      $allSchedule = $this->connection->Execute($query);

      foreach ($allSchedule as $value) {
        $schedule = new Schedule();
        $schedule->setScheduleId($value['scheduleId']);
        $schedule->setStartDate($value['startDate']);
        $schedule->setEndDate($value['endDate']);
        $schedule->setState($value['state']);
        $schedule->setPersonId($value['personId']);
        $schedule->setSize($value['size']);
        $schedule->setPet_type($value['pet_type']);
        $schedule->setCost($value['cost']);

        array_push($scheduleList, $schedule);
      }

      return $scheduleList;
    } catch (\PDOException $ex) {
      throw $ex;
    }
  }

  public function getScheduleById($personId)
  {
    try {       


      $scheduleList = array();

      $query = "SELECT * FROM agenda a
                INNER JOIN person p ON p.personId = a.personId
                WHERE p.personId = '$personId' 
                AND (SELECT MAX(a.scheduleId) FROM agenda) 
                ORDER BY a.scheduleId  DESC;";

      $this->connection = Connection::GetInstance();
      $allSchedule = $this->connection->Execute($query);

      foreach ($allSchedule as $value) {
        $schedule = new Schedule();
        $schedule->setScheduleId($value['scheduleId']);
        $schedule->setStartDate($value['startDate']);
        $schedule->setState($value['state']);
        $schedule->setEndDate($value['endDate']);
        $schedule->setSize($value['size']);
        $schedule->setPet_type($value['pet_type']);
        $schedule->setCost($value['cost']);

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
                WHERE personId = '$personId';";

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

?>
