<?php

namespace Views;

require_once "Config\Autoload.php";

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
$totalCost = $schedule->getCost() * $dias + $schedule->getCost() * $dias * 0.31;

?>
      
      
      <section>
        <div class="fullCont">
         <div class="100cont">
         <div class="division"></div>
          <div style="float:right;margin-bottom:5px"></div>
          <div class="alineador" style=" border:1px #555 solid;width:100%;background-image:url(bg.png);color:#000;padding:5px 0 5px 0;-webkit-border-radius: 10px;border-radius: 10px;">
           <div class="tit">PET HERO</div>
           <div class="subTit">Cuidado de Mascotas en Mar del Plata y Zona Atlántica</div>
         </div>
       </div>

       <div class="100cont">
        <div class="alineador" >
        </div>
      </div>
      <div class="100cont">
        <div class="contPrimInfo">
          <div class="lineaCont">
           <div class="leftCont1">Keeper:</div>
           <div class="leftCont2"><?php echo $person->getLastname(); echo " "; echo $person->getFirstname(); ?></div>
         </div>
         <div class="lineaCont">
           <div class="leftCont1">Cuenta corriente N°:</div>
           <div class="leftCont2">14887466/32</div>
         </div>
         <div class="lineaCont">
           <div class="leftCont1">Nro. de CUIT:</div>
           <div class="leftCont2"><?php echo $person->getDni(); ?></div>
         </div>
         <div class="lineaCont">
           <div class="leftCont1">Localidad:</div>
           <div class="leftCont2"><?php echo "Mar del Plata"; ?></div>
         </div>
         <div class="lineaCont" >
           <div class="leftCont1">Razon social:</div>
           <div class="leftCont2"><?php echo $person->getLastname(); echo " "; echo $person->getFirstname(); ?></div>
         </div>
         <div class="lineaCont">
           <div class="leftCont1">Email:</div>
           <div class="leftCont2"><?php echo $person->getEmail(); ?></div>
         </div>
         <div class="lineaCont">
           <div class="leftCont1">Address:</div>
           <div class="leftCont2"><?php echo "Colon 1200"; ?></div>
         </div>
         <div class="lineaCont">
           <div class="leftCont1">Phone:</div>
           <div class="leftCont2"><?php echo "223546-9714"; ?></div>
         </div>

         <div class="lineaCont2">
         <div class="leftCont3" style="-webkit-border-radius: 5px 0px 0px 0px;border-radius: 5px 0px 0px 0px;">Work settled period
         </div>
         <div class="leftCont4" style="-webkit-border-radius: 0px 0px 0px 5px;border-radius: 0px 0px 0px 5px;"><?php echo date("F", strtotime($book->getStartDateBook())); ?>
         </div>
       </div>
       <div class="lineaCont2">
         <div class="leftCont3">Year</div>
         <div class="leftCont4"><?php echo $year = date("Y"); ?>
       </div>
     </div>
     <div class="lineaCont2">
      <div class="leftCont3">Totalt days
      </div>
      <div class="leftCont4"><?php echo $dias; ?>
      </div>
    </div>
    <div class="lineaCont2">
      <div class="leftCont3">1st Payment due
      </div>
      <div class="leftCont4"> <?php echo date("d-m-y", strtotime($book->getStartDateBook())); ?>
      </div>
    </div>
    <div class="lineaCont2">
      <div class="leftCont3">2nd Payment due
      </div>
      <div class="leftCont4"> <?php echo date("d-m-y", strtotime($book->getEndDateBook())); ?>
      </div>
    </div>
    <div class="lineaCont2">
      <div class="leftCont3">Total</div>
      <div class="leftCont4">$<?php echo $schedule->getCost() * $dias; ?></div>
    </div>

   <div class="lineaCont2">
     <div class="leftCont3" style="-webkit-border-radius: 0px 5px 0px 0px;border-radius: 0px 5px 0px 0px;">Total Cost</div>
     <div class="leftCont4" style="-webkit-border-radius: 0px 0px 5px 0px;border-radius: 0px 0px 5px 0px;">$<?php echo $totalCost; ?></div>
   </div>
   <div class="lineaCont3">
     <div class="leftCont5">Discounts
     </div>
     <div class="lineaDescuentos">
      <div class="leftCont8">Union contribution
      </div>
      <div class="leftCont6"><?php echo "3%"; ?>
      </div>
      <div class="leftCont7">$<?php echo $schedule->getCost() * $dias * 0.03; ?>
      </div>
    </div>

    <div class="lineaDescuentos">
      <div class="leftCont8">Employer Contribution - Funeral
      </div>
      <div class="leftCont6"><?php echo "1%"; ?>
      </div>
      <div class="leftCont7">$<?php echo $schedule->getCost() * $dias * 0.01; ?>
      </div>
    </div>
    <div class="lineaDescuentos">
      <div class="leftCont8">Employee Contribution - Funeral
      </div>
      <div class="leftCont6"><?php echo "1%"; ?>
      </div>
      <div class="leftCont7">$<?php echo $schedule->getCost() * $dias * 0.01; ?>
      </div>
    </div>
    <div class="lineaDescuentos">
      <div class="leftCont8">Co-insurance</div>
      <div class="leftCont6"><?php echo "3%"; ?></div>
      <div class="leftCont7">$<?php echo $schedule->getCost() * $dias * 0.02; ?></div>
    </div>

    <div class="lineaDescuentos">
      <div class="leftCont8">Other charges</div>
      <div class="leftCont6"><?php echo "2%"; ?></div>
      <div class="leftCont7">$<?php echo $schedule->getCost() * $dias * 0.02; ?></div>
    </div>

    <div class="lineaDescuentos">
      <div class="leftCont8">IVA</div>
      <div class="leftCont6"><?php echo "21%"; ?></div>
      <div class="leftCont7">$<?php echo $schedule->getCost() * $dias * 0.21; ?></div>
    </div>

    <div class="lineaDescuentos">
         <div class="leftCont8"><b>Surcharge payment</b> (1st Payment due)</div>
         <b><div class="leftCont6">$<?php echo $totalCost * 0.05; ?></div></b>
       </div>

       <div class="lineaDescuentos">
         <div class="leftCont8"><b>Surcharge payment</b> (2nd Payment due)</div>
         <b><div class="leftCont6">$<?php echo $totalCost * 0.12; ?></div></b>
       </div>

    <div class="lineaDescuentos">
        <div class="leftCont8"><b>SubTotal</b> (%50 booking)</div>
        <b><div class="leftCont6">$<?php echo $totalCost / 2; ?></div></b>
      </div>

    <b><div class="lineaDescuentos">
         <div class="leftCont8">Total Cost</div>
         <div class="leftCont6">$<?php echo $totalCost; ?></div>
       </div></b>



  <div class="division"></div>
  <div class="division"></div>

  <div class="container-sm mx-auto">  
  
        <?php if($book->getStateBook() == 1) {         
                 if($book->getStatePayment() == 0) {  ?>       
  <button type="submit" name="btnPayment" class="btn btn-sm m-2 btn-outline-success float-left">
	<a href="<?php if (isset($schedule)) {
	 	echo FRONT_ROOT . "Book/Payment/" . $book->getBookId();
	}; ?>">Pay Bill</a>
											</button>
            <?php } } ?>
     <a class="float-right m-2" style="font-size: 14px;" href="<?php echo FRONT_ROOT ?>Book/OwnerView">Go back</a>
     <a class="btn btn-sm m-2 btn-outline-dark ml-auto d-block float-left" href='javascript:window.print(); void 0;'>Print</a> 
            </div>

</div>
</section>