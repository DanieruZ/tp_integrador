<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\BookDAO as BookDAO;
use DAO\ReviewDAO as ReviewDAO;

$review = [];
$user = $_SESSION['owner'];
[$owner] = $user;

$bookDAO = new BookDAO();
$bookList = $bookDAO->getOwnerBook($owner->getPersonId());

//* esto trae las reservas pero siempre trae la ultima
//* tenemos que traer de alguna forma el kepperId para que add review funcione
//* correctamente. porque al crear un keeper nuevo su review 
//* siempre se la agraga al ultimo con review
if($bookList){
	[$book] = $bookList;
	$bookInfo = $bookDAO->getBookInfoOwner($book->getBookId());
	[$book, $schedule, $person, $pet] = $bookInfo;
}

/*
echo "<pre>";
print_r($bookList);
echo "</pre>";
*/


$reviewDAO = new ReviewDAO();
$keeperRate = $reviewDAO->getRateById($owner->getPersonId()); //* este tendria que ser el keeperId
[$rate] = $keeperRate;

print_r($owner->getPersonId()); echo " ownerId";
echo "<br>";
print_r($person->getPersonId());  echo " personId - el ultimo keeper con review";

//* si le pasamos $person->getPersonId() siempre pasa el ultimo con review
$reviewList = $reviewDAO->getReviewById($owner->getPersonId()); //* este tendria que ser el keeperId, 
if (!empty($reviewList))																				//* los dejo porque si no se rompe
[$review] = $reviewList;




?>

<main class="py-5">
<form action="<?php echo FRONT_ROOT ?>Review/OwnerAddView" method="POST" class="bg-light p-5">
	<section class="mb-5">
		<div class="container-fluid">
			<h2 class="mb-4">My Bookings</h2>

			<table class="table bg-light">
				<thead class="bg-dark text-white">
					<th>Start Date</th>
					<th>End Date</th>
					<th>State</th>
					<th>State Payment</th>
					<th>Reserve Info</th>
					<th>Review</th>


				</thead>
				<?php
				if (isset($bookList)) {
					foreach ($bookList as $book) {
				?>
						<tbody>
							<tr>
								<td><?php echo $book->getStartDateBook(); ?></td>
								<td><?php echo $book->getEndDateBook(); ?></td>
								<?php if ($book->getStateBook() == 0) { ?>
									<td><?php echo "Pending" ?> </td> <?php
																	} ?>
								<?php if ($book->getStateBook() == 1) { ?>
									<td><?php echo "Confirmed" ?> </td> <?php
																	} ?>
								<?php if ($book->getStateBook() == 2) { ?>
									<td><?php echo "Declined" ?> </td> <?php
																	} ?>
								<?php if ($book->getStatePayment() == 0) { ?>
									<td><?php echo "Unpaid" ?> </td> <?php
																	} ?>
								<?php if ($book->getStatePayment() == 1) { ?>
									<td><?php echo "Paid" ?> </td> <?php
																} ?>
								<?php if ($book->getStatePayment() == 2) { ?>
									<td><?php echo "Payment declined" ?> </td> <?php
																			} ?>
								
								<td><button type="submit" class="btn btn-sm btn-outline-info">
										<a href="<?php if (isset($bookList)) {
														echo FRONT_ROOT . "Book/GetBookInfoOwner/" . $book->getBookId();
													}; ?>">View Info</a>
									</button></td>
								
								<div>
								<td>
								
									<?php if ($book->getStatePayment() == 1 && $book->getStateReview() != 1 ) {             ?>									
								<input type="hidden" id="personId" name="personId" value="<?php echo $person->getPersonId()?>">
								<?php print_r($person->getPersonId());?>
								<input type="hidden" id="bookId" name="bookId" value="<?php echo $book->getBookId() ?>">
								<button type="submit" class="btn btn-sm btn-outline-dark ml-auto d-block float-left">Add Review</button>
									<?php  }             ?>
								</td>
								</div>
							</tr>
						</tbody>
				<?php
					}
				}
				?>
			</table>
		</div>
	</section>
	</form>
</main>

<?php include('footer.php') ?>