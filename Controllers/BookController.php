<?php

namespace Controllers;

use DAO\BookDAO;
use Models\Book as Book;
use Utils\Utils as Utils;

class BookController {

  private $bookDAO;

  public function __construct() {
    $this->bookDAO = new BookDAO();
  }

  public function OwnerView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-book.php");
  }

  public function KeeperView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-book.php");
  }

}

?>