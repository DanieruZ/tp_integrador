<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\KeeperDAO as KeeperDAO;

$keeperDAO = new KeeperDAO;
$keeperInfo = $keeperDAO->getKeeperById($personId);
[$person] = $keeperInfo;

?>

<script>
$(document).ready(function(){
    $('input.star').rating();
});
</script>

<main class="py-5">
<section class="mb-5">
	<div class="container">
		<form action="<?php echo FRONT_ROOT ?>Review/AddReview" method="POST" class="bg-light p-5">
			<h2 class="mb-4 p-1 bg-dark text-white">Add Review</h2>
      <div class="col-lg-4">
				<div class="form-group">
          <input type="hidden" id="personId" name="personId" value="<?php echo $person->getPersonId(); ?>">
        </div>
			</div>
          <div class="col-lg-4">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" class="form-control">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="message">Message</label>
					<textarea name="message" class="form-control"></textarea>
				</div>
			</div>
			<div class="col-lg-4">
				<p>Select your rating</p>
				<div class="form-group clasificacion">
        <input id="radio1" name="rate" value="5" type="radio"/><!--
				--><label for="radio1">★</label><!--
        --><input id="radio2" name="rate" value="4" type="radio"/><!--
				--><label for="radio2">★</label><!--
        --><input id="radio3" name="rate" value="3" type="radio" checked="checked"/><!-- 
				--><label for="radio3">★</label><!--
        --><input id="radio4" name="rate" value="2" type="radio"/><!--
				--><label for="radio4">★</label><!--
        --><input id="radio5" name="rate" value="1" type="radio"/><!--
				--><label for="radio5">★</label>
				</div>
			</div>
			<button type="submit" class="btn btn-sm btn-outline-dark ml-auto d-block float-left">Add</button>
			<a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Keeper/OwnerListView">Go back</a>
		</form>
	</div>
</section>
</main>