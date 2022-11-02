<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\BookDAO as BookDAO;

$user = $_SESSION['keeper'];
[$person] = $user;

$bookDAO = new BookDAO();
$bookList = $bookDAO->getKeeperBook($person->getPersonId());

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
           <th>Payment</th>
				   <th>Book Info</th>
				  
					
			  </thead>
<?php
  if(isset($bookList)) {
    foreach ($bookList as $book) {
?>
			  <tbody>	  				
				  <tr>
					 	<td><?php echo $book->getStartDate(); ?></td>
						<td><?php echo $book->getEndDate(); ?></td>						
						<?php if($book->getState() == 0 ){?> 
						<td><?php echo "Pending";?></td> <?php
						} ?>
						<?php if($book->getState() == 1 ){?> 
						<td><?php echo "Confirmed";?></td> <?php
						} ?> 
						<?php if($book->getState() == 2 ){?> 
						<td><?php echo "Declined";?></td> <?php
						} ?>  
            <td>UNPAID</td>	
						<td><button type="submit" name="btnViewInfo" class="btn btn-sm btn-outline-info">
          		<a href="<?php if (isset($bookList)) {
              	echo FRONT_ROOT . "Book/GetBookInfoKeeper/" . $book->getBookId();
            	}; ?>">View Info</a>
						</button></td>	
						
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