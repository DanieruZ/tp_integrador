<?php

namespace Views;

use DAO\KeeperDAO;
use DAO\ScheduleDAO;

require_once "Config\Autoload.php";
require_once "keeper-nav.php";

$scheduleDAO = new ScheduleDAO();
$scheduleList = $scheduleDAO->getScheduleById();

if ($scheduleList) {
  [$schedule] = $scheduleList;

  if ($schedule->getState() == 1) {

?>

<main class="py-5">
<section class="mb-5">
  <div class="container-fluid">
    <div class="container-sm mx-auto" style="width:400px">
      <h3>My Schedule</h3>
    </div>
    <div class="container-sm mx-auto shadow" style="width:400px">
      <ul class="list-group">
        <li class="list-group-item">Start Date: <?php echo $schedule->getStartDate(); ?></li>
        <li class="list-group-item">End Date: <?php echo $schedule->getEndDate(); ?></li>
      </ul> 
    </div>
    <div class="d-flex justify-content-center mb-3">
    <button type="submit" name="btnRemove" class="btn btn-outline-danger w-25 m-5">
      <a href="<?php if(isset($schedule)) {
        echo FRONT_ROOT . "Schedule/DeleteSchedule";
      }; ?>">Delete Schedule</a>
    </button>
    </div>
  </div>
</section>

<?php
}
}

if (!$scheduleList || $schedule->getState() == 0) {

?>

<section class="mb-5">
<form action="<?php echo FRONT_ROOT ?>Schedule/AddSchedule" method="POST" class="p-5">
  <div class="container-sm mx-auto shadow" style="width:400px">
    <div class="form-group ">
      <label for="startDate">Start Date:</label>
      <input type="date" id="startDate" name="startDate" class="form-control form-control-lg w-50">
    </div>
    <div class="form-group">
      <label for="endDate">End Date:</label>
      <input type="date" id="endDate" name="endDate" class="form-control form-control-lg w-50">
    </div>
    <button class="btn btn-dark" type="submit">Register</button>
  </div>
</form>
</section>

<?php
}
?>
</main>

<?php include('footer.php') ?>

