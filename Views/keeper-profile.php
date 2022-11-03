<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\PetDAO as PetDAO;

$user = $_SESSION['owner'];
[$person] = $user;
$ownerId = $person->getPersonId();

$keeperDAO = new KeeperDAO;
$keeperInfo = $keeperDAO->getKeeperById($personId);
[$keeper] = $keeperInfo;

$scheduleDAO = new ScheduleDAO;
$scheduleInfo = $scheduleDAO->getScheduleById($personId);
[$schedule] = $scheduleInfo;

$petDAO = new PetDAO;
$petList = $petDAO->getMyPet($ownerId);
if (!empty($petList)){  
[$pet] = $petList;
}

if(isset($petId)){  
$petInfo = $petDAO->getPetById($petId);
[$petinformation] = $petInfo;

}

?>

<section class="mb-5">
<div class="container-sm mx-auto" style="width:400px">
  <h3>Select Your Pet</h3>
</div>

<form action="<?php echo FRONT_ROOT ?>keeper/ProfileKeeperPet" method="POST" class="container-sm mx-auto shadow" style="width:400px">
  <div class="form-group">
  <select name="petId" required class="form-control form-control-ml">
    <option style="color:grey" required selected hidden>pet</option>
    <?php

    if (isset($petList)) {
      foreach ($petList as $pet) {
        ?>  <option value="<?php echo $pet->getPetId(); ?> "> <?php echo $pet->getPetName(); ?></option> <?php
      } 
    }
    else{
      echo "No pets available.";
    }
    ?>
     <input type="hidden" id="personId" name="personId" value="<?php echo $keeper->getPersonId(); ?>">
 </select>
 <button type="submit" class="btn btn-sm m-2 btn-outline-dark ml-auto d-block float-left">Select</button>

</div>
</form>
</section>


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

  
<section class="mb-6">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Keeper Schedule</h3>
        </div>
        <div class="container-sm mx-auto" style="width:400px">
          <form action="<?php echo FRONT_ROOT ?>Book/OwnerReserve" method="POST" class="container-sm mx-auto shadow" style="width:400px">
            <ul class="list-group">
              <input type="hidden" id="personId" name="personId" value="<?php echo $keeper->getPersonId(); ?>">
              <li class="list-group-item" for="startDate">Start Date: <input type="date" id="startDate" name="startDate" value="<?php echo $schedule->getStartDate(); ?>" min="<?php echo $schedule->getStartDate(); ?>" class="form-control form-control-lg w-50"> </li>
              <li class="list-group-item" for="endDate">End Date: <input type="date" id="endDate" name="endDate" value="<?php echo $schedule->getEndDate(); ?>" min="<?php echo $schedule->getStartDate(); ?>" max="<?php echo $schedule->getEndDate(); ?>" class="form-control form-control-lg w-50"> </li>
              <li name="cost" class="list-group-item">Cost x Day: $<?php echo $schedule->getCost(); ?></li>
              <li name="pet_type" class="list-group-item">Pet Type: <?php echo $schedule->getPet_type(); ?></li>
              <li name="size" class="list-group-item">Size: <?php echo $schedule->getSize(); ?></li>
            </ul> 
            <input type="hidden" id="petId" name="petId" value="<?php echo $petId ?>">
            <?php if(isset($petinformation ) )             
              if(strcmp($petinformation->getPet_type(), $schedule->getPet_type()) === 0){               
                ?> 
            <button type="submit" class="btn btn-sm m-2 btn-outline-dark ml-auto d-block float-left">Reserve</button>
            
          </form>
        </div>
      </div>
      <div class="container-sm mx-auto" style="width:400px">
      <?php
          }else{       
            echo "The Keeper is not available for this pet.";
          } ?> 
        <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Keeper/OwnerListView">Go back</a>
      </div>
</section>
</main>

<?php include('footer.php') ?>