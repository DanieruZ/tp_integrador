<?php

namespace DAO;

use Models\Person as Person;

interface IOwnerDAO {

	function addOwner(Person $person);
	function getAllOwner();
	
}

?>