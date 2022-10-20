<?php

namespace DAO;

use Models\Pet as Pet;

interface IPetDAO {

	function addPet(Pet $pet);
	function getPetLastId();
	function addPetOwner($personId, $petId);
	function getAllPet();
	function getMyPet($personId);
	
}

?>