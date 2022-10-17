<?php

namespace DAO;

interface IUserDAO {

	function getAllUser();
	function getUserByEmail($email);
	
}

?>