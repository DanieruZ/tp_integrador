<main class="py-5">
<section class="mb-5">
  <div class="container">
	  <form action="<?php echo FRONT_ROOT ?>Pet/AddPet" method="POST" class="bg-light p-5">
		  <h2 class="mb-4 p-1 bg-dark text-white">Add Owner</h2>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="petname">Petname</label>
					<input type="text" name="petname" class="form-control">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="size">Size</label>
					<input type="text" name="size" class="form-control">
				</div>
			</div>
      <div class="col-lg-4">
				<div class="form-group">
					<label for="pet_type">Pet Type</label>
					<input type="text" name="pet_type" class="form-control">
				</div>
			</div>
      <div class="col-lg-4">
				<div class="form-group">
					<label for="breed">Breed</label>
					<input type="text" name="breed" class="form-control">
				</div>
			</div>
			  <button type="submit" class="btn btn-outline-primary ml-auto d-block float-left">Add</button>					
	  </form>
	</div>
</section>
</main>