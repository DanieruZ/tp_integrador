<?php

namespace DAO;

use Models\Book as Book;

interface IBookDAO
{

	function addBook(Book $book);
	function getAllBook();
	function getActiveBook();
	function getBookLastId();
	function addPersonBook($keeperId);
	function getOwnerBook($personId);
	function getKeeperBook($personId);
}