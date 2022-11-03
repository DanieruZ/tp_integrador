<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\BookDAO as BookDAO;

$user = $_SESSION['owner'];
[$person] = $user;

$bookDAO = new BookDAO();
$bookList = $bookDAO->getOwnerBook($person->getPersonId());

//$petId = $_POST['petId'];

//echo "<pre>";
//print_r($bookList);
//echo "</pre>";
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
					<th>Reserve Info</th>


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
								<td><button type="submit" name="btnViewInfo" class="btn btn-sm btn-outline-info">
										<a href="<?php if (isset($bookList)) {
														echo FRONT_ROOT . "Book/GetBookInfoOwner/" . $book->getBookId();
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