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
$booInfo = $bookDAO->getBookInfoOwner($bookId);
[$book,$schedule, $person, $pet] = $booInfo;


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

<section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Detail payment</h3>
        </div>
        <div class="container-sm mx-auto" style="width:400px">         
        <ul class="list-group">                      
            <li class="list-group-item">Start Date: <?php echo $book->getStartDateBook(); ?> </li>         
            <li class="list-group-item">End Date: <?php echo $book->getEndDateBook(); ?> </li>    
            <li class="list-group-item">Cantidad de dias: <?php echo $dias ; ?> </li>        
            <li class="list-group-item">Costo individual por dia : $<?php echo $schedule->getCost() ?></li>
            <li class="list-group-item">Cost Total: $<?php echo $schedule->getCost() * $dias ?></li>        
            <input type="hidden" id="state" name="endDate" value="<?php echo $endDate ?>">           
          </ul>

        <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Book/OwnerView">Go back</a>
       
        <?php if($book->getStatePayment() != 1 || $book->getStatePayment() == 2){               
                ?> 
           <button type="submit" name="btnPayment" class="btn btn-sm btn-outline-info">
		   <a href="<?php if (isset($schedule)) {
		   echo FRONT_ROOT . "Book/Payment/" . $book->getBookId();
		   }; ?>">Pagar</a>
		 </button>
            <?php }?> 
      </div>
</section>


</main>

<?php include('footer.php') ?>