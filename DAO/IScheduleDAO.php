<?php

namespace DAO;

use Models\Schedule as Schedule;

interface IScheduleDAO {

	function addSchedule(Schedule $schedule);
	function getScheduleById($personId);
	function getSchedule();
	function deleteSchedule();

}

?>