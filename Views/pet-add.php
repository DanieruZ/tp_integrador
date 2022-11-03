<main class="py-5">
<section class="mb-5">
	<div class="container">
		<form action="<?php echo FRONT_ROOT ?>Pet/AddPet" method="POST" class="bg-light p-5">
			<h2 class="mb-4 p-1 bg-dark text-white">Add Pet</h2>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="petname">Petname</label>
					<input type="text" name="petname" class="form-control">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="size">Size</label>
					<select name="size">
						<option name="size" id="small" value="small" required selected>Small </option>
						<option name="size" id="medium" value="medium">Medium </option>
						<option name="size" id="large" value="large">Large </option>
						<option name="size" id="x-large" value="x-large">X-Large </option>
					</select>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="pet_type">Pet Type</label>
					<select name="pet_type">
						<option name="pet_type" id="dog" value="dog" required selected>Dog </option>
						<option name="pet_type" id="cat" value="cat">Cat </option>
						<option name="pet_type" id="bird" value="bird">Bird </option>
					</select>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="breed">Breed</label>
					<input type="text" name="breed" class="form-control">
				</div>
			</div>
			<button type="submit" class="btn btn-outline-dark btn-sm ml-auto d-block float-left">Add</button>
		  <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Pet/OwnerListView">Go back</a>
		</form>
	</div>
</section>
</main>