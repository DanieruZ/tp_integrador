<?php

namespace Views;

use DAO\KeeperDAO;
use DAO\ScheduleDAO;

require_once "Config\Autoload.php";
require_once "keeper-nav.php";

$user = $_SESSION['keeper'];
[$person] = $user;
$personId = $person->getPersonId();

$scheduleDAO = new ScheduleDAO();
$scheduleList = $scheduleDAO->getScheduleById($personId);

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
              <a href="<?php if (isset($schedule)) {
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
            <input type="date" id="startDate" name="startDate" min="<?php echo  $fcha = date("Y-m-d"); ?>" class="form-control form-control-lg w-50">
          </div>

          <div class="form-group" style="width:400px">
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" min="<?php echo  $fcha = date("Y-m-d"); ?>" class="form-control form-control-lg w-50">
          </div>

          <div class="form-group">
            <label for="cost">Cost for a day:</label>
            <input type="input" id="cost" name="cost" placeholder="enter the price" class="form-control form-control-lg w-50">
          </div>      

          <div class="form-group" style="width:400px">
            <label for="size">Size of Dog:</label>
            <select name="size">
              <option name="size" id="small" value="small" required selected>Small </option>
              <option name="size" id="medium" value="medium">Medium </option>
              <option name="size" id="large" value="large">Large </option>
              <option name="size" id="x-large" value="x-large">X-Large </option>
            </select>
          </div>

          <div class="form-group" style="width:400px">
            <label for="pet_type">Pet Type</label>
            <select name="pet_type">
              <option name="pet_type" id="dog" value="dog" required selected>Dog </option>
              <option name="pet_type" id="cat" value="cat">Cat </option>
              <option name="pet_type" id="bird" value="bird">Bird </option>
            </select>
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