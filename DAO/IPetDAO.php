<?php

namespace DAO;

use Models\Pet as Pet;

interface IPetDAO {

	function addPet(Pet $pet);
	function getPetLastId();
	function addPetOwner();
	function getAllPet();
	function getMyPet($personId);
	function deletePetById($petId);
	function getPetById($petId);
	
}

?>