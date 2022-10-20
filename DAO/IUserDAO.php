<?php

namespace DAO;
use Models\Person as Person;

interface IUserDAO {
    function AddPerson(Person $person);
	function getAllUser();
	function getUserByEmail($email);
	
}

?>