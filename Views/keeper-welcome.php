<?php

namespace Views;

require_once "Config\Autoload.php";
require_once "keeper-nav.php";

$userList = $_SESSION['keeper'];
[$keeper, $user, $rol] = $userList;

?>

<main class="py-5">
<section class="mb-5">
  <div class="container-fluid">		
		<div class="container-sm mx-auto" style="width:400px">
      <h3>MIS DATOS</h3>
    </div>
		<div class="container-sm mx-auto shadow" style="width:400px">                
		  <ul class="list-group">                       
        <li class="list-group-item">First Name: <?php echo $keeper->getFirstname(); ?></li>
        <li class="list-group-item">Last Name: <?php echo $keeper->getLastname(); ?></li>
        <li class="list-group-item">DNI: <?php echo $keeper->getDni(); ?></li>
        <li class="list-group-item">Gender: <?php echo $keeper->getGender(); ?></li>
        <li class="list-group-item">Email: <?php echo $user->getEmail(); ?></li>
      </ul>
    </div>
  </div>
</section>
</main>

<?php include('footer.php') ?>
