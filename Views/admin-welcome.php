<?php

namespace Views;

require_once "Config\Autoload.php";
require_once "admin-nav.php";

$userList = $_SESSION['admin'];
[$admin] = $userList;

?>

<main class="py-5">
<section class="mb-5">
  <div class="container-fluid">		
		<div class="container-sm mx-auto" style="width:400px">
      <h3>MIS DATOS</h3>
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
</main>

<?php include('footer.php') ?>