<?php

namespace Controllers;

use DAO\PetDAO as PetDAO;
use Models\Pet as Pet;
use Utils\Utils as Utils;

class PetController {

  private $petDAO;
  
  public function __construct() {
    $this->petDAO = new PetDAO();
  } 

  public function OwnerAddView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "pet-add.php");
  }

  public function OwnerProfileView($petId) {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "pet-profile.php");
  }

  public function OwnerListView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "pet-owner-list.php");
  }

  public function KeeperListView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "pet-list.php");
  }

  public function AdminListView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "admin-nav.php");
    require_once(VIEWS_PATH . "pet-list.php");
  }

  public function AddPet($petname, $size, $pet_type, $breed) {
    //Utils::checkOwnerSession();    
    $pet = new Pet();   

    if ($pet) {            
      $pet = new Pet();
      $pet->setPetname($petname);
      $pet->setSize($size);
      $pet->setPet_type($pet_type);
      $pet->setBreed($breed);

      $this->petDAO->addPet($pet);
      $this->petDAO->addPetOwner();
      $this->OwnerListView();       
    }
  }

  public function DeletePet($petId) {
    //Utils::checkOwnerSession();
    $this->petDAO->deletePetById($petId);
    $this->OwnerListView();
  }

  public function UpdatePet($petId, $petname, $size, $pet_type, $breed) {
    //Utils::checkOwnerSession(); 
    $pet = new Pet(); 

    if ($pet) {            
      $pet = new Pet();

      $pet->setPetId($petId);
      $pet->setPetname($petname);
      $pet->setSize($size);
      $pet->setPet_type($pet_type);
      $pet->setBreed($breed);

      $this->petDAO->updatePet($pet);
      //$this->petDAO->updatePet($petId, $petname, $size, $pet_type, $breed);
      $this->OwnerListView();
    }
  }

}

?>