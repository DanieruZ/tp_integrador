<?php

namespace Views;

use DAO\KeeperDAO;

require_once "Config\Autoload.php";
require_once "keeper-nav.php";


$keeperList = $_SESSION['keeper'];
[$keeper] = $keeperList;

$keeperDAO = new KeeperDAO();
$keeperId = $keeper->getPersonId();
$scheduleList = $keeperDAO->getScheduleById($keeperId);

if($scheduleList){
[$schedule] = $scheduleList;


?>

<main class="py-5">
<section class="mb-5">
  <div class="container-fluid">		
		<div class="container-sm mx-auto" style="width:400px">
      <h3>My Schedule</h3>
    </div>
		<div class="container-sm mx-auto shadow" style="width:400px">                
		  <ul class="list-group">                       
        <li class="list-group-item">Start Date: <?php echo $schedule->getStartDate(); ?></li>
        <li class="list-group-item">End Date: <?php echo $schedule->getEndDate(); ?></li>       
      </ul>
    </div>
  </div>
  <div class="content">
  </header>
  <?php
 }else{
  echo "<h2 style>No tiene una Agenda</h2>";
 }
 ?>

<form action="<?php echo FRONT_ROOT ?>Schedule/AddSchedule" method="POST" class="p-5">
<?php print_r($keeperId);?>
  <div class="container-sm mx-auto shadow" style="width:400px">
  <div class="form-group ">
  <input type="hidden" value= <?php echo($keeperId);?> name="keeperId">
    </div>
  <div class="form-group ">
      <label for="startDate">Start Date:</label>
      <input type="date" id="startDate" name="startDate" class="form-control form-control-lg w-50" >
    </div>
    <div class="form-group">
      <label for="endDate">End Date:</label>
      <input type="date" id="endDate" name="endDate" class="form-control form-control-lg w-50" >
    </div>
   <button class="btn btn-dark" type="submit">Register</button>
</div>
</form>

</div>



</section>
</main>

<?php include('footer.php') ?>

<?php
/*
<main class="d-flex align-items-center justify-content-center height-100" >
<div class="content">
  <header class="text-center">
    <h2>Schedule</h2>
  </header>

<form action="<?php echo FRONT_ROOT ?>Keeper/fecha" method="POST" class="p-5">

  <p>Start date: <input type="date" name="fechaInicio"></p>
  <p>End date: <input type="date" name="fechaFin">
   <input type="submit" value="Enviar datos"></p>

</form>

</div>
</main>*/
?>

<?php
  
date_default_timezone_set("America/Buenos_Aires");
 #Domingo 0, Lunes 1... Sábado 6

$dia_actual = intval(date("w")); #Convertir siempre a entero para evitar errores

if ($dia_actual != 6 && $dia_actual != 0 ) {
    # Aquí la acción que se realice en el horario permitido
    //echo "Bienvenido, visitante";
} else {
    # Mostrar un aviso
    //echo "No se permiten visitantes en este día";
}

