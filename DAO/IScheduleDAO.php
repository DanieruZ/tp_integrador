<?php

namespace DAO;

use Models\Schedule as Schedule;

interface IScheduleDAO {

	function addSchedule(Schedule $schedule);
	function getSchedule();
  function getScheduleById($personId);
  function deleteSchedule();

}

?>





