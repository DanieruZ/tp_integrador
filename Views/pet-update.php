<?php

use Models\Pet as Pet;
use DAO\PetDAO as PetDAO;

$petDAO = new PetDAO();
$petList = $petDAO->getPetById($petId);
//[$pet] = $petList;
$pet = $petList[0];

?>

<!--<main class="py-5">
<section class="mb-5">
	<div class="container">
		<form action="<?php // echo FRONT_ROOT ?>Pet/UpdatePet" method="POST" class="bg-light p-5">
			<h2 class="mb-4 p-1 bg-dark text-white">Pet Update</h2>
      <div class="col-lg-4">
				<div class="form-group">
          <input type="hidden" name="petId" value="<?php // echo $pet->getPetId(); ?>">
          <label for="petId"></label>
          <input type="number" name="petId" value="<?php // echo $pet->getPetId(); ?>" class="form-control" required>
        </div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="petname">Petname</label>
					<input type="text" name="petname" value="<?php // echo $pet->getPetname(); ?>" class="form-control" required>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="size">Size</label>
					<select name="size" value="<?php // echo $pet->getSize(); ?>">
						<option name="size" id="small" value="<?php // echo $pet->getSize(); ?>" required selected>Small </option>
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
						<option name="pet_type" id="dog" value="<?php // echo $pet->getPet_type(); ?>" required selected>Dog </option>
						<option name="pet_type" id="cat" value="cat">Cat </option>
						<option name="pet_type" id="bird" value="bird">Bird </option>
					</select>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="breed">Breed</label>
					<input type="text" name="breed" value="<?php // echo $pet->getBreed(); ?>" class="form-control">
				</div>
			</div>
			<button type="submit" class="btn btn-outline-dark ml-auto d-block float-left">Save</button>
      <a class="float-right" href="<?php // echo FRONT_ROOT ?>Pet/OwnerListView">Go back</a>
		</form>
	</div>
</section>
</main>-->

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">update <?php echo $pet->getPetname(); ?></h2>
            <form action="<?php echo FRONT_ROOT ?>Pet/UpdatePet" method="POST" class="bg-light-alpha p-5">
                <div class="col">                   
                    <div class="col-lg-4">
                        <div class="form-group">                       
                            <input type="hidden" name="petId" value="<?php echo $pet->getPetId(); ?>">
                           <label >id</label>
                            <input type="number" name="petId" value="<?php echo $pet->getPetId(); ?>" class="form-control" Required>
                            <label for="petname">name</label>
                            <input type="text" name="petname" value="<?php echo $pet->getPetname(); ?>" class="form-control" Required>
                            <label for="size">size</label>
                            <input type="text" name="size" value="<?php echo $pet->getSize(); ?>" class="form-control" Required>
                            <label for="pet_type">pet_type</label>
                            <input type="text" name="pet_type" value="<?php echo $pet->getPet_type(); ?>" class="form-control" Required>
                            <label for="breed">breed</label>
                            <input type="text" name="breed" value="<?php echo $pet->getBreed(); ?>" class="form-control" Required>
                                                        
                        </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
            </form>
        </div>
    </section>
</main