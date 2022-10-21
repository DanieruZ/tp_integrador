<?php

namespace DAO;

use Models\Schedule as Schedule;

interface IScheduleDAO {

	function addSchedule($personId,Schedule $schedule);
	public function getSchedule();
	
	
}

?>