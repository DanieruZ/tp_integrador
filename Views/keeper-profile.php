<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;

$keeperDAO = new KeeperDAO;
$keeperInfo = $keeperDAO->getKeeperById($personId);
[$keeper] = $keeperInfo;

print_r($keeper->getPersonId());

$scheduleDAO = new ScheduleDAO;
$scheduleInfo = $scheduleDAO->getScheduleById($personId);
[$schedule] = $scheduleInfo;

print_r($schedule->getStartDate());


?>

<main class="py-5">
  <section class="mb-5">
    <div class="container-fluid">
      <div class="container-sm mx-auto" style="width:400px">
        <h3>Keeper Profile</h3>
      </div>
      <div class="container-sm mx-auto shadow" style="width:400px">
        <ul class="list-group">
          <li class="list-group-item">First Name: <?php echo $keeper->getFirstname(); ?></li>
          <li class="list-group-item">Last Name: <?php echo $keeper->getLastname(); ?></li>
          <li class="list-group-item">DNI: <?php echo $keeper->getDni(); ?></li>
          <li class="list-group-item">Email: <?php echo $keeper->getEmail(); ?></li>
          <li class="list-group-item">Gender: <?php echo $keeper->getGender(); ?></li>
        </ul>
      </div>
    </div>
  </section>
  <form action="<?php echo FRONT_ROOT ?>Book/OwnerReserve" method="POST" class="bg-light p-5">
    <section class="mb-6">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Keeper Schedule</h3>
        </div>
        <div class="container-sm mx-auto shadow" style="width:400px">
          <ul class="list-group">
            <input type="hidden" id="personId" name="personId" value="<?php echo $keeper->getPersonId(); ?>">
            <li for="startDate">Start Date: <input type="date" id="startDate" name="startDate" value="<?php echo $schedule->getStartDate(); ?>" min="<?php echo $schedule->getStartDate(); ?>" class="form-control form-control-lg w-50"> </li>
              <li for="endDate">End Date:  <input type="date" id="endDate" name="endDate" value="<?php echo $schedule->getEndDate(); ?>" min="<?php echo $schedule->getStartDate(); ?>" max="<?php echo $schedule->getEndDate(); ?>" class="form-control form-control-lg w-50"> </li>
              <li name="cost" class="list-group-item">Cost for a Day: $<?php echo $schedule->getCost(); ?></li>
              <li name="size" class="list-group-item">Size Que cuida: <?php echo $schedule->getSize(); ?></li>
              <li name="pet_type" class="list-group-item">Pet Type Que cuida: <?php echo $schedule->getPet_type(); ?></li>
          </ul>
          <button type="submit"  class="btn btn-sm btn-outline-info"> Reserve</button>
          <a class="float-right m-3" href="<?php echo FRONT_ROOT ?>Keeper/OwnerListView">Go back</a>
        </div>
      </div>
    </section>
  </form>

</main>

<?php include('footer.php') ?>