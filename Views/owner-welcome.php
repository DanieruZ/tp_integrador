<?php

namespace Views;

require_once "Config\Autoload.php";
require_once "owner-nav.php";

$ownerList = $_SESSION['owner'];
[$owner] = $ownerList;

?>

<main class="py-5">
<section class="mb-5">
  <div class="container-fluid">		
	  <div class="container-sm mx-auto" style="width:400px">
      <h3>MIS DATOS</h3>
    </div>
	  <div class="container-sm mx-auto shadow" style="width:400px">                
		  <ul class="list-group">                       
        <li class="list-group-item">First Name: <?php echo $owner->getFirstname(); ?></li>
        <li class="list-group-item">Last Name: <?php echo $owner->getLastname(); ?></li>
        <li class="list-group-item">DNI: <?php echo $owner->getDni(); ?></li>
        <li class="list-group-item">Email: <?php echo $owner->getEmail(); ?></li>
        <li class="list-group-item">Gender: <?php echo $owner->getGender(); ?></li>
        <li class="list-group-item">USERID: <?php echo $owner->getRolId(); ?></li>
      </ul>
    </div>
  </div>
</section>
</main>

<?php include('footer.php') ?>