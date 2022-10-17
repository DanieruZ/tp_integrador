<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use Utils\Utils as Utils;

class KeeperController {

  private $keeperDAO;
  
  public function __construct() {
    $this->keeperDAO = new KeeperDAO();
  }

  public function WelcomeView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-welcome.php");
  }

  public function AddView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-add.php");
  }

  public function ListView() {
    //Utils::checkKeeperSession();
    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function AdminListView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "admin-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

}

?>