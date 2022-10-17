<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\OwnerDAO as OwnerDAO;

$ownerDAO = new OwnerDAO();
$personList = $ownerDAO->getAllOwner();

?>

<main class="py-5">
  <section class="mb-5">
	  <div class="container-fluid">
		  <h2 class="mb-4">Owner's List</h2>

		  <table class="table bg-light">
			  <thead class="bg-dark text-white">
				   <th>ID</th>
				   <th>First Name</th>
				   <th>Last Name</th>
				   <th>DNI</th>
					 <th>Email</th>
				   <th>Gender</th>
			  </thead>
<?php
  if(isset($personList)) {
    foreach ($personList as $person) {
?>
			  <tbody>	  				
				  <tr>
					  <td><?php echo $person->getPersonId(); ?></td>
					 	<td><?php echo $person->getFirstname(); ?></td>
						<td><?php echo $person->getLastname(); ?></td>
						<td><?php echo $person->getDni(); ?></td>
						<td><?php echo $person->getEmail(); ?></td>	
						<td><?php echo $person->getGender(); ?></td>	
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