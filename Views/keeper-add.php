<main class="py-5">
	<section class="mb-5">
		<div class="container">

			<form action="<?php echo FRONT_ROOT ?>Keeper/AddKeeper" method="POST" class="p-5">
				<h2 class="mb-4 p-1 text-white bg-dark">Add Keeper</h2>

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
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" class="form-control">
					</div>
				</div>
				<div class="col-lg-4">
					<p>Gender Option.</p>
					<div class="form-group">
						<input type="radio" name="gender" id="Female" value="Female" required>
						<label for="female">female</label><br>
						<input type="radio" name="gender" id="Male" value="Male">
						<label for="male">male</label><br>
						<input type="radio" name="gender" id="Other" value="Other">
						<label for="other">other</label><br>
					</div>
				</div>
				<button type="submit" class="btn btn-dark ml-auto d-block float-left">Submit</button>
		</div>


		</form>
		</div>
	</section>
</main>