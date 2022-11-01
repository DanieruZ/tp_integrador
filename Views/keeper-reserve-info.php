<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\petDAO as PetDAO;
use DAO\bookDAO as BookDAO;
use DateTime;

$user = $_SESSION['owner'];
[$person] = $user;


$bookDAO = new BookDAO;
$reserveInfo = $bookDAO->getOwnerBook($person->getPersonId());
[$reserve] = $reserveInfo;

print_r($reserve);


$keeperDAO = new KeeperDAO;
$keeperInfo = $keeperDAO->getKeeperById($personId);
[$keeper] = $keeperInfo;

print_r($keeper);

$scheduleDAO = new ScheduleDAO;
$scheduleInfo = $scheduleDAO->getScheduleById($personId);
[$schedule] = $scheduleInfo;


$fecha1 = new DateTime($startDate);
$fecha2 = new DateTime($endDate);
$diff = $fecha1->diff($fecha2);
$dias = 1 + $diff->days;


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

   
    <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Book/OwnerView">Go back</a>

</main>

<?php include('footer.php') ?>