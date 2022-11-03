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
//$booInfo = $bookDAO->getBookInfoKeeper($keeper->getPersonId());
$booInfo = $bookDAO->getBookInfoKeeper($bookId);
[$book, $schedule, $person, $pet] = $booInfo;

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

?>

<main class="py-5">
<form action="<?php echo FRONT_ROOT ?>Book/KeeperSendInfoReserve" method="POST" class="bg-light p-1">
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
          <li class="list-group-item">Start Date: <?php echo $book->getStartDateBook(); ?> </li>
          <li class="list-group-item">End Date: <?php echo $book->getEndDateBook(); ?> </li>
          <li class="list-group-item">Cost x <?php echo $dias ?> dias: $<?php echo $schedule->getCost() * $dias ?></li>
          <li class="list-group-item">Pet Size: <?php echo $schedule->getSize(); ?></li>
          <li class="list-group-item">Pet Type: <?php echo $schedule->getPet_type(); ?></li>
         
        </ul>
      </div>
      <div class="container-sm mx-auto" style="width:400px">
      <input type="hidden" id="bookId" name="bookId" value="<?php echo $book->getBookId() ?>">   
      <input type="hidden" id="endDateBook" name="endDateBook" value="<?php echo $book->getEndDateBook() ?>">   
      <input type="hidden" id="scheduleId" name="scheduleId" value="<?php echo $schedule->getScheduleId() ?>">
        <button type="submit" name="button" value="1" class="btn btn-sm m-2 btn-outline-dark ml-auto d-block float-left">Confirm</button>
        <button type="submit" name="button" value="2"class="btn btn-sm m-2 btn-outline-dark ml-auto d-block float-left">Cancell</button>
        <a class="float-right m-3" href="<?php echo FRONT_ROOT ?>Book/KeeperView">Go back</a>
      </div>
    </div>
  </section>

  </form>


</main>

<?php include('footer.php') ?>