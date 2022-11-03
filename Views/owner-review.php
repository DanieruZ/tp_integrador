<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\ReviewDAO as ReviewDAO;

$ownerList = $_SESSION['owner'];
[$owner] = $ownerList;

$reviewDAO = new ReviewDAO();
$reviewList = $reviewDAO->getReviewById($owner->getPersonId());

?>

<main class="py-5">
  <section class="mb-5">
	  <div class="container-fluid">
		  <h2 class="mb-4">My Reviews</h2>

		  <table class="table bg-light">
			  <thead class="bg-dark text-white">
				   <th>Title</th>
				   <th>Message</th>
				   <th>Rate</th>
			  </thead>
<?php
  if(isset($reviewList)) {
    foreach ($reviewList as $review) {
?>
			  <tbody>	  				
				  <tr>
					 	<td><?php echo $review->getTitle(); ?></td>
						<td><?php echo $review->getMessage(); ?></td>
						<td><?php echo $review->getRate(); ?></td>
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