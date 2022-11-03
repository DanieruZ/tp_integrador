<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\petDAO as PetDAO;
use DateTime;

$petDAO = new PetDAO;
$petInfo = $petDAO->getPetById($petId);
[$pet] = $petInfo;

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

$keeperDAO = new KeeperDAO;
$keeperInfo = $keeperDAO->getKeeperById($personId);
[$keeper] = $keeperInfo;

$scheduleDAO = new ScheduleDAO;
$scheduleInfo = $scheduleDAO->getScheduleById($personId);
[$schedule] = $scheduleInfo;

$fecha1 = new DateTime($startDate);
$fecha2 = new DateTime($endDate);
$diff = $fecha1->diff($fecha2);
$dias = 1 + $diff->days;

?>

  <main class="py-5">
  <form action="<?php echo FRONT_ROOT ?>Book/AddBook" method="POST" >
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


    <section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Pet Profile</h3>
        </div>
        <div class="container-sm mx-auto shadow" style="width:400px">
          <ul class="list-group">
            <li class="list-group-item">Petname: <?php echo $pet->getPetname(); ?></li>
            <li class="list-group-item">Pet Type: <?php echo $pet->getPet_type(); ?></li>
            <li class="list-group-item">Size: <?php echo $pet->getSize(); ?></li>
            <li class="list-group-item">Breed: <?php echo $pet->getBreed(); ?></li>
          </ul>
        </div>
      </div>
    </section>



    <section class="mb-6">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Schedule Selected</h3>
        </div>
        <div class="container-sm mx-auto shadow" style="width:400px">

          <ul class="list-group">
            <input type="hidden" id="keeperId" name="keeperId" value="<?php echo $keeper->getPersonId(); ?>">            
            <li class="list-group-item">Start Date: <?php echo $startDate; ?> </li>
            <input type="hidden" id="startDate" name="startDate" value="<?php echo $startDate ?>">
            <li class="list-group-item">End Date: <?php echo $endDate; ?> </li>
            <input type="hidden" id="endDate" name="endDate" value="<?php echo $endDate ?>">
            <li class="list-group-item">Cost x <?php echo $dias ?> days: $<?php echo $schedule->getCost() * $dias ?></li>
            <li class="list-group-item">Pet Type: <?php echo $schedule->getPet_type(); ?></li>
            <li class="list-group-item">Size: <?php echo $schedule->getSize(); ?></li>
            <input type="hidden" id="state" name="endDate" value="<?php echo $endDate ?>">
          </ul>
          <input type="hidden" id="petId" name="petId" value="<?php echo $petId ?>">
          <button type="submit" class="btn btn-sm m-2 btn-outline-dark ml-auto d-block float-left">Confirm</button>
          <a class="btn btn-sm btn-outline-danger m-2" href="<?php echo FRONT_ROOT ?>Keeper/OwnerListView">Cancel</a>
        </div>
      </div>
    </section>
    

</form>

</main>

<?php include('footer.php') ?>