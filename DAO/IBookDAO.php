<?php

namespace DAO;

use Models\Book as Book;

interface IBookDAO
{

	function addBook(Book $book);
	function getAllBook();
	function getActiveBook();
	function getBookLastId();
	function addPersonBook($keeperId,$petId);
	function getOwnerBook($personId);
	function getKeeperBook($personId);
	function getBookInfoOwner($personId);
	function getBookInfoKeeper($personId);
	function aceptReserve($bookId);
}

?>
