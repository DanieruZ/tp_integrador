<?php

namespace Views;

require_once "Config\Autoload.php";

?>

<main class="py-5">
	<section class="mb-5">
		<div class="container-fluid">
			<h2 class="mb-4" style="text-align:center ;">Pet's List</h2>
			<table class="table bg-light">
				<thead class="bg-dark text-white">
					<th>Petname</th>
					<th>Size</th>
					<th>Pet type</th>
					<th>Breed</th>
					<th></th>
				</thead>
				<?php
				if (isset($petList)) {
					foreach ($petList as $pet) {
				?>
						<tbody>
							<tr>
								<td><?php echo $pet->getPetname(); ?></td>
								<td><?php echo $pet->getSize(); ?></td>
								<td><?php echo $pet->getPet_type(); ?></td>
								<td><?php echo $pet->getBreed(); ?></td>
								<td>
									<button type="submit" name="btnUpdate" class="btn btn-sm btn-outline-warning">
										<a href="<?php if (isset($petList)) {
														echo FRONT_ROOT . "Pet/UpdatePet/" . $pet->getPetId();
													}; ?>">Update</a>
									</button>
									<button type="submit" name="btnRemove" class="btn btn-sm btn-outline-danger">
										<a href="<?php if (isset($petList)) {
														echo FRONT_ROOT . "Pet/DeletePet/" . $pet->getPetId();
													}; ?>">Delete</a>
									</button>
								</td>
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