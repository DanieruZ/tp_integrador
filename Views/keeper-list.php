<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use Models\Schedule;

$keeperDAO = new KeeperDAO;
$personList = $keeperDAO->getAllKeeper();

$scheduleDAO = new ScheduleDAO();
$scheduleList = $scheduleDAO->getSchedule();

?>

<main class="py-5">
<section class="mb-5">
	<div class="container-fluid">
		<h2 class="mb-4">Keeper's List</h2>
		<table class="table bg-light">
		  <thead class="bg-dark text-white">
				<th>First Name</th>
				<th>Last Name</th>
				<th>DNI</th>
				<th>Date Start</th>
				<th>End Start</th>
				<th></th>
			</thead>
<?php

if(isset($personList)) {	
	foreach ($personList as $person) {		
		if(isset($scheduleList)) {	
			foreach ($scheduleList as $schedule) {	
				if($schedule->getPersonId() == $person->getPersonId()) { 
?>
			<tbody>	  				
				<tr>
					<td><?php echo $person->getFirstname(); ?></td>
					<td><?php echo $person->getLastname(); ?></td>
					<td><?php echo $person->getDni(); ?></td>
					<td><?php echo $schedule->getStartDate(); ?></td>
					<td><?php echo $schedule->getEndDate(); ?></td>
					<td>
						<button type="submit" name="btnProfile" class="btn btn-sm btn-outline-info">
          		<a href="<?php if (isset($schedule)) {
              	echo FRONT_ROOT . "Keeper/keeperProfile/" . $person->getPersonId();
            	}; ?>">Profile</a>
						</button>
					</td>
				</tr>
			</tbody>
<?php 
}
}
}
}
}
?>
		</table>
	</div>
</section>
</main>

<?php include('footer.php') ?>
