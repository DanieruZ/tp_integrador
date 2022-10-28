<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\PetDAO as PetDAO;
use DateTime;

$user = $_SESSION['owner'];
[$person] = $user;
$ownerId = $person->getPersonId();

$petDAO = new PetDAO;
$petList = $petDAO->getMyPet($ownerId);
[$pet] = $petList;


$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

$keeperDAO = new KeeperDAO;
$keeperInfo = $keeperDAO->getKeeperById($personId);
[$keeper] = $keeperInfo;

$scheduleDAO = new ScheduleDAO;
$scheduleInfo = $scheduleDAO->getScheduleById($personId);
[$schedule] = $scheduleInfo;


$fecha1= new DateTime( $startDate); 

$fecha2= new DateTime( $endDate); 

$diff = $fecha1->diff($fecha2);

$dias =1 + $diff->days;


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

<section class="mb-5">
<div class="container-fluid">
  <div class="container-sm mx-auto" style="width:400px">
    <h3>Select Your Pet</h3>
  </div>

  <form action="<?php echo FRONT_ROOT ?>Book/AddBook" method="POST" class="container-sm mx-auto shadow" style="width:400px">
    <div class="form-group">
    <select name="petId" name="petname" required class="form-control form-control-ml">
      <option style="color:grey" hidden selected>pet</option>
      <?php

      if (isset($petList)) {
        foreach ($petList as $pet) {
          echo "<option value=" . $pet->getPetId() . ">" . $pet->getPetname() . "</option>";
        } 
      }
      ?>
   </select>
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
          <li class="list-group-item" for="startDate">Start Date: <input type="date" id="startDate" name="startDate" value="<?php echo $startDate; ?>" class="form-control form-control-lg w-50" readonly> </li>
          <li class="list-group-item" for="endDate">End Date: <input type="date" id="endDate" name="endDate" value="<?php echo $endDate; ?>" class="form-control form-control-lg w-50" readonly> </li>
          <li class="list-group-item">Start Date: <?php echo $startDate; ?> </li>
          <li class="list-group-item">End Date: <?php echo $endDate; ?> </li>
          <li class="list-group-item">Cost x <?php echo $dias ?> dias  : $<?php echo $schedule->getCost() * $dias ?></li>
          <li class="list-group-item">Size Que cuida: <?php echo $schedule->getSize(); ?></li>
          <li class="list-group-item">Pet Type Que cuida: <?php echo $schedule->getPet_type(); ?></li>
        </ul>
        <button type="submit" class="btn btn-sm m-2 btn-outline-dark ml-auto d-block float-left">Confirm</button>
      </form>
          <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Keeper/OwnerListView">Cancel</a>

      </div>
    </div>
  </section>


</main>

<?php include('footer.php') ?>