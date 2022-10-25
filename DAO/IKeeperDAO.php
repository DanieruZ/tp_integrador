<?php

namespace DAO;

use Models\Person as Person;

interface IKeeperDAO {

	function addKeeper(Person $person);
	function getAllKeeper();
	
}

?>