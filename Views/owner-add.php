<main class="py-5">
<section class="mb-5">
  <div class="container">
	  <form action="<?php echo FRONT_ROOT ?>Owner/AddOwner" method="POST" class="bg-light p-5">
		  <h2 class="mb-4 p-1 bg-dark text-white">Add Owner</h2>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="firstname">Firstname</label>
					<input type="text" name="firstname" class="form-control">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="lastname">Lastname</label>
					<input type="text" name="lastname" class="form-control">
				</div>
			</div>
      <div class="col-lg-4">
				<div class="form-group">
					<label for="dni">DNI</label>
					<input type="number" name="dni" class="form-control">
				</div>
			</div>
      <div class="col-lg-4">
				<p>Choose an option.</p>
				<div class="form-group">
					<input type="radio" name="gender">
					<label for="female">female</label><br>
					<input type="radio" name="gender">
          <label for="male">male</label><br>
					<input type="radio" name="gender">
          <label for="other">other</label><br>
				</div>
			</div>
			  <button type="submit" class="btn btn-outline-primary ml-auto d-block float-left">Add</button>					
	  </form>
	</div>
</section>
</main>