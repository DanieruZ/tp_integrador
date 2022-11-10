<?php

namespace Views;

require_once "Config\Autoload.php";

use DAO\petDAO as PetDAO;

$petDAO = new PetDAO;
$petInfo = $petDAO->getPetById($petId);
[$pet] = $petInfo;

$imageProfile = addslashes($pet->getThumbnail());
$imageVaccination = addslashes($pet->getVaccination());

//print_r(base64_encode(stripslashes($datos_image)));

?>

<head>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="<?php echo CSS_PATH ?>pet-style.css">

</head>

<main class="py-5">
<section class="mb-5">
<div class="container-fluid">		
	<div class="container-sm text-center">
    <h3>My Profile</h3>
  </div>

  <div class="row m-0 justify-content-center align-items-center">

    <div class="col-md-3"></div>

    <div class="col-md-6">

    <form action="<?php echo FRONT_ROOT ?>Pet/AddThumbnail" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="petId" name="petId" value="<?php echo $petId; ?>" />
    <div class="profile-img">
      <div>
        <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(stripslashes($imageProfile)).''; ?>"  class="img-thumbnail" style="width:400px"/>
      </div>
      <div class="file btn btn-lg btn-secondary">
        Change Image
        <input type="file" name="file" />
      </div>
      
    </div>
    
    </form>

      <div class="container-sm shadow" style="width:400px">
      <div class="list-group">
        <li class="list-group-item">Petname: <?php echo $pet->getPetname(); ?></li>
        <li class="list-group-item">Size: <?php echo $pet->getSize(); ?></li>
        <li class="list-group-item">Pet Type: <?php echo $pet->getPet_type(); ?></li>
        <li class="list-group-item">Breed: <?php echo $pet->getBreed(); ?></li>

   
    <!-- Button to Open the Modal -->
        <a class="list-group-item" href="" data-toggle="modal" data-target="#myModal">
           Schedule Vaccination</a>
     </ul>  
     </div>
     <a class="float-right m-3" href="<?php echo FRONT_ROOT ?>Pet/OwnerListView">Go back</a> 
    
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width:500px">
      
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Schedule Vaccination</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        
          <!-- Modal body -->
          <div class="modal-body">
          <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(stripslashes($imageVaccination)).''; ?>"  class="img-thumbnail" style="width:600px"/>
          </div> 

        </div>
      </div>
    </div>   

    <div class="col-md-3"></div>

  </div>
</div>
</section>
</main>

<?php include('footer.php') ?>