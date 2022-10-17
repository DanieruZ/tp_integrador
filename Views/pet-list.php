<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\PetDAO as PetDAO;

$repo = new PetDAO;
$petList = $repo->getAllPet();

?>

<main class="py-5">
<section class="mb-5">
  <div class="container-fluid">
	  <h2 class="mb-4">Pet's List</h2>
		<table class="table bg-light">
		  <thead class="bg-dark text-white">
				<th>ID</th>
			  <th>Petname</th>
				<th>Size</th>
				<th>Pet type</th>
				<th>Breed</th>
      </thead>
<?php
  if(isset($petList)) {
    foreach ($petList as $pet) {
?>
	    <tbody>	  				
			  <tr>
			 		<td><?php echo $pet->getPetId(); ?></td>
				  <td><?php echo $pet->getPetname(); ?></td>
					<td><?php echo $pet->getSize(); ?></td>
					<td><?php echo $pet->getPet_type(); ?></td>
					<td><?php echo $pet->getBreed(); ?></td>	
				</tr>
			</tbody>
<?php 
  }
 }
?>
		</table>
  </div>
</section>
</main>

<?php include('footer.php') ?>