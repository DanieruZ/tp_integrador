<?php

namespace DAO;
use Models\Person as Person;

interface IUserDAO {
  function AddUser(Person $person);
	function getAllUser();
	function getUserByEmail($email);
	
}

?>