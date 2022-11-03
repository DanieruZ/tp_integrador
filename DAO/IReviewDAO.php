<?php

namespace DAO;

use Models\Review as Review;

interface IReviewDAO {

	function addReview(Review $review);
	function getReviewById($personId);
	function getRate($personId);
  	
}

?>