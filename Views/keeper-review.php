<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\ReviewDAO as ReviewDAO;

$keeperList = $_SESSION['keeper'];
[$keeper] = $keeperList;

$reviewDAO = new ReviewDAO();
$reviewList = $reviewDAO->getReviewById($keeper->getPersonId());

$keeperRate = $reviewDAO->getRateById($keeper->getPersonId());
[$rate] = $keeperRate;

?>

<main class="py-5">
  <section class="mb-5">
	  <div class="container-fluid">
		  <h2 class="mb-4">My Reviews</h2>
			<div class="container bg-warning col-sm-2 text-center">
				<h5>Rate: <?php echo (int)$rate[0]; ?>/5&#9733</h5>
		  </div>
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
						<td><?php echo $review->getRate(); ?>★</td>
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