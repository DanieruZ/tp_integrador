<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\BookDAO as BookDAO;
use DAO\ReviewDAO as ReviewDAO;

$bookDAO = new BookDAO();

$keeperDAO = new KeeperDAO;
$personList = $keeperDAO->getAllKeeper();

$scheduleDAO = new ScheduleDAO();
$scheduleList = $scheduleDAO->getSchedule();

?>

<main class="py-5">
	<section class="mb-5">
		<div class="container-fluid">
			<h2 class="mb-4">Keeper's List</h2>
			<form action="<?php echo FRONT_ROOT ?>Keeper/GetKeeperByAvailableDate" method="POST" class="bg-light p-1">
				<p><b>Search by available dates.</b></p>
				<div class="form-group">
					<input type="date" id="startDate" name="startDate" class="form-control form-control w-25 ">
				</div>
				<div class="form-group">
					<input type="date" id="endDate" name="endDate" class="form-control form-control w-25">
				</div>
				<button type="submit" class="btn btn-sm btn-outline-dark float-left m-2">Search</button>
			</form>
		</div>

		<table class="table bg-light">
			<thead class="bg-dark text-white">
				<th>First Name</th>
				<th>Last Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Rate</th>
				<th>Info</th>
			</thead>
			<?php

			if (isset($personList)) {
				foreach ($personList as $person) {
					if (isset($scheduleList)) {
						foreach ($scheduleList as $schedule) {
							if ($schedule->getPersonId() == $person->getPersonId()) {
			?>
								<?php						

								$reviewDAO = new ReviewDAO();
								$reviewList = $reviewDAO->getReviewById($person->getPersonId());
								if (!empty($reviewList))
									[$review] = $reviewList;
								$keeperRate = $reviewDAO->getRate($person->getPersonId());
								[$rate] = $keeperRate;


								?>
								<tbody>
									<tr>
										<td><?php echo $person->getFirstname(); ?></td>
										<td><?php echo $person->getLastname(); ?></td>
										<td><?php echo $schedule->getStartDate(); ?></td>
										<td><?php echo $schedule->getEndDate(); ?></td>
										<td><?php echo (int)$rate[0]; ?></td>
										<td>
											<button type="submit" name="btnProfile" class="btn btn-sm btn-outline-info">
												<a href="<?php if (isset($schedule)) {
																echo FRONT_ROOT . "Keeper/Profile/" . $person->getPersonId();
															}; ?>">Profile</a>

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