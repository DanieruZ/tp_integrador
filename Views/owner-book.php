<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\BookDAO as BookDAO;

$bookDAO = new BookDAO();
$bookList = $bookDAO->getAllBook();

//$petId = $_POST['petId'];

echo "<pre>";
print_r($bookList);
echo "</pre>";
?>

<main class="py-5">
  <section class="mb-5">
	  <div class="container-fluid">
		  <h2 class="mb-4">My Bookings</h2>

		  <table class="table bg-light">
			  <thead class="bg-dark text-white">
				   <th>Start Date</th>
				   <th>End Date</th>
           <th>State</th>
					 <th>Pet ID</th>
			  </thead>
<?php
  if(isset($bookList)) {
    foreach ($bookList as $book) {
?>
			  <tbody>	  				
				  <tr>
					 	<td><?php echo $book->getStartDate(); ?></td>
						<td><?php echo $book->getEndDate(); ?></td>
						<td><?php echo $book->getState(); ?></td>
						<td><?php echo $book->getPetId(); ?></td>
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