<?php

namespace Controllers;

use DAO\AdminDAO as AdminDAO;
use Utils\Utils as  Utils;


class AdminController {

  private $adminDAO;

  public function __construct() {
    $this->adminDAO = new AdminDAO();
  }

  public function WelcomeView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "admin-nav.php");
    require_once(VIEWS_PATH . "admin-welcome.php");
  }

  public function ListView() {
    //Utils::checkAdminSession();
    require_once(VIEWS_PATH . "admin-nav.php");
    require_once(VIEWS_PATH . "admin-list.php");
  }

}

?>