<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\petDAO as PetDAO;

$petDAO = new PetDAO;
$petInfo = $petDAO->getPetById($petId);
[$pet] = $petInfo;

?>

<main class="py-5">
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
     <a class="float-right m-3" href="<?php echo FRONT_ROOT ?>Pet/OwnerListView">Go back</a> 
    </div>    
  </div>
</section>
</main>

<?php include('footer.php') ?>