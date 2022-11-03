<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\petDAO as PetDAO;
use DAO\bookDAO as BookDAO;
use DateTime;


$user = $_SESSION['owner'];
[$owner] = $user;

$bookDAO = new BookDAO;
//$booInfo = $bookDAO->getBookInfoOwner($owner->getPersonId());
$booInfo = $bookDAO->getBookInfoOwner($bookId);
[$book,$schedule, $person, $pet] = $booInfo;

//$scheduleDAO = new ScheduleDAO;
//$scheduleList = $scheduleDAO->getScheduleById($person->getPersonId());

$startDate = $book->getStartDateBook();
$endDate = $book->getEndDateBook();
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
echo "holaaaa";
?>

  <main class="py-5"> 
    <section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Keeper Profile</h3>
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
            <li class="list-group-item">Start Date: <?php echo $book->getStartDateBook(); ?> </li>         
            <li class="list-group-item">End Date: <?php echo $book->getEndDateBook(); ?> </li>           
            <li class="list-group-item">Cost x <?php echo $dias ?> dias : $<?php echo $schedule->getCost() * $dias ?></li>
            <li class="list-group-item">Size Que cuida: <?php echo $schedule->getSize(); ?></li>
            <li class="list-group-item">Pet Type Que cuida: <?php echo $schedule->getPet_type(); ?></li>
            <input type="hidden" id="state" name="endDate" value="<?php echo $endDate ?>">
          </ul>

        <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Book/OwnerView">Go back</a>
        <?php if($book->getStateBook() == 1){               
                ?> 
            <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Book/Prueba">Pagar</a>
            <?php }?> 
      </div>
</section>


</main>

<?php include('footer.php') ?>