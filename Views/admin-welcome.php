<?php

namespace Views;

require_once "Config\Autoload.php";
require_once "admin-nav.php";

$adminList = $_SESSION['admin'];
[$admin] = $adminList;

?>

<main class="py-5">
  <section class="mb-5">
    <div class="container-fluid">
      <div class="container-sm mx-auto" style="width:400px">
        <h3>My Profile</h3>
      </div>
      <div class="container-sm mx-auto shadow" style="width:400px">
        <ul class="list-group">
          <li class="list-group-item">First Name: <?php echo $admin->getFirstname(); ?></li>
          <li class="list-group-item">Last Name: <?php echo $admin->getLastname(); ?></li>
          <li class="list-group-item">DNI: <?php echo $admin->getDni(); ?></li>
          <li class="list-group-item">Email: <?php echo $admin->getEmail(); ?></li>
          <li class="list-group-item">Gender: <?php echo $admin->getGender(); ?></li>
        </ul>
      </div>
    </div>
  </section>
</main>

<?php include('footer.php') ?>