<?php

namespace DAO;

use Models\Schedule;
use DAO\IScheduleDAO as IScheduleDAO;

use DAO\Connection as Connection;

class ScheduleDAO implements IScheduleDAO {

  private $connection;

  public function addSchedule($personId,Schedule $schedule) {
    try {
      $query = "INSERT INTO agenda (personId, startDate, endDate) 
                VALUES (:personId, :startDate, :endDate)";

      $parameters['startDate'] = $schedule->getStartDate();
      $parameters['endDate'] = $schedule->getEndDate();
      $parameters['scheduleId'] = $personId;

      $this->connection = Connection::GetInstance();
      return $this->connection->executeNonQuery($query, $parameters);

    } catch (\PDOException $ex) {
        throw $ex;
      }
  }


}

?>  