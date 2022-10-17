<?php

namespace Controllers;

use DAO\OwnerDAO as OwnerDAO;
use Utils\Utils as Utils;

class OwnerController {

  private $ownerDAO;

  public function __construct() {
    $this->ownerDAO = new OwnerDAO();
  }

  public function WelcomeView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-welcome.php");
  }

  public function AddView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-add.php");
  }

  public function ListView() {
    //Utils::checkOwnerSession();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "owner-list.php");
  }

  public function AdminListView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "admin-nav.php");
    require_once(VIEWS_PATH . "owner-list.php");
  }
  
}

?>