<?php

namespace Views;

require_once "Config\Autoload.php";

?>

<main class="py-5">
  <form action="<?php echo FRONT_ROOT ?>Book/KeeperSendInfoReserve" method="POST" class="bg-light p-1">
    <section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Owner Profile</h3>
        </div>
        <div class="container-sm mx-auto shadow" style="width:400px">
          <ul class="list-group">
            <li class="list-group-item">First Name: <?php echo $person->getFirstname(); ?></li>
            <li class="list-group-item">Last Name: <?php echo $person->getLastname(); ?></li>
            <li class="list-group-item">DNI: <?php echo $person->getDni(); ?></li>
            <li class="list-group-item">Email: <?php echo $person->getEmail(); ?></li>
            <li class="list-group-item">Gender: <?php echo $person->getGender(); ?></li>
          </ul>
        </div>
      </div>
    </section>


    <section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Pet Profile</h3>
        </div>
        <div class="container-sm mx-auto shadow" style="width:400px">
          <ul class="list-group">
            <li class="list-group-item">Petname: <?php echo $pet->getPetname(); ?></li>
            <li class="list-group-item">Pet Type: <?php echo $pet->getPet_type(); ?></li>
            <li class="list-group-item">Size: <?php echo $pet->getSize(); ?></li>
            <li class="list-group-item">Breed: <?php echo $pet->getBreed(); ?></li>
          </ul>
        </div>
      </div>
    </section>

    <section class="mb-5">
      <div class="container-fluid">
        <div class="container-sm mx-auto" style="width:400px">
          <h3>Keeper Schedule</h3>
        </div>
        <div class="container-sm mx-auto" style="width:400px">
          <ul class="list-group">
            <li class="list-group-item">Start Date: <?php echo $book->getStartDateBook(); ?> </li>
            <li class="list-group-item">End Date: <?php echo $book->getEndDateBook(); ?> </li>
            <li class="list-group-item">Cost x <?php echo $dias ?> days: $<?php echo $schedule->getCost() * $dias ?></li>
            <li class="list-group-item">Pet Type: <?php echo $schedule->getPet_type(); ?></li>
            <li class="list-group-item">Pet Size: <?php echo $schedule->getSize(); ?></li>
          </ul>
        </div>
        <div class="container-sm mx-auto" style="width:400px">
          <input type="hidden" id="bookId" name="bookId" value="<?php echo $book->getBookId() ?>">
          <input type="hidden" id="endDateBook" name="endDateBook" value="<?php echo $book->getEndDateBook() ?>">
          <input type="hidden" id="scheduleId" name="scheduleId" value="<?php echo $schedule->getScheduleId() ?>">

          <?php if ($book->getStateBook() == 0) { ?>

            <button type="submit" name="stateValue" value="1" class="btn btn-sm m-2 btn-outline-success ml-auto d-block float-left">Confirm</button>
            <button type="submit" name="stateValue" value="2" class="btn btn-sm m-2 btn-outline-danger ml-auto d-block float-left">Cancel</button>

        </div>

      <?php } ?>
      <div class="container-sm mx-auto" style="width:400px">
        <a class="float-right m-2" href="<?php echo FRONT_ROOT ?>Book/KeeperView">Go back</a>
      </div>
    </section>

  </form>


</main>

<?php include('footer.php') ?>