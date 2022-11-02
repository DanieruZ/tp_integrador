<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\petDAO as PetDAO;
use DAO\bookDAO as BookDAO;
use DateTime;

$user = $_SESSION['keeper'];
[$keeper] = $user;



$bookDAO = new BookDAO;
$booInfo = $bookDAO->getBookInfoKeeper($keeper->getPersonId());
[$book, $schedule, $person,$pet] = $booInfo;

$startDate = $schedule->getStartDate();
$endDate = $schedule->getEndDate();
$fecha1 = new DateTime($startDate);
$fecha2 = new DateTime($endDate);
$diff = $fecha1->diff($fecha2);
$dias = 1 + $diff->days;


echo "<pre>";
print_r($book);
print_r($schedule);
print_r($person);
print_r($pet);
echo "</pre>";

?>

  <main class="py-5"> 
    <section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Owner Profile</h3>
        </div>
        <div class="container-sm mx-auto shadow" style="width:400px">
          <ul class="list-group">
            <li class="list-group-item">First Name: <?php echo $person->getFirstname(); ?></li>
            <li class="list-group-item">Last Name: <?php echo $person->getLastname(); ?></li>
            <li class="list-group-item">DNI: <?php echo $person->getDni(); ?></li>
            <li class="list-group-item">Email: <?php echo $person->getEmail(); ?></li>
            <li class="list-group-item">Gender: <?php echo $person->getGender(); ?></li>
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
        <li class="list-group-item">Size: <?php echo $pet->getSize(); ?></li>
        <li class="list-group-item">Pet Type: <?php echo $pet->getPet_type(); ?></li>
        <li class="list-group-item">Breed: <?php echo $pet->getBreed(); ?></li>
      </ul>    
    </div>    
  </div>
</section>

<section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Keeper Schedule</h3>
        </div>
        <div class="container-sm mx-auto" style="width:400px">         
        <ul class="list-group">                      
            <li class="list-group-item">Start Date: <?php echo $schedule->getStartDate(); ?> </li>         
            <li class="list-group-item">End Date: <?php echo $schedule->getEndDate(); ?> </li>           
            <li class="list-group-item">Cost x <?php echo $dias ?> dias : $<?php echo $schedule->getCost() * $dias ?></li>
            <li class="list-group-item">Size Que cuida: <?php echo $schedule->getSize(); ?></li>
            <li class="list-group-item">Pet Type Que cuida: <?php echo $schedule->getPet_type(); ?></li>
            <input type="hidden" id="state" name="endDate" value="<?php echo $endDate ?>">
          </ul>
          <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Book/KeeperAceptReserve/.5">Cancel</a>
          <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Book/KeeperAceptReserve/ . <?php echo $book->getBookId?> ">Confirm</a>
        

      </div>
</section>


</main>

<?php include('footer.php') ?>