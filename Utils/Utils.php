<?php 

namespace Utils;

class Utils {

  public static function checkAdminSession() {
    if(!(isset($_SESSION['admin']))) {
      Utils::logout();
    }
}

public static function checkOwnerSession() {
    if(!(isset($_SESSION['owner']))) {
      Utils::logout();
    }
}

public static function checkKeeperSession() {
    if(!(isset($_SESSION['keeper']))) {
      Utils::logout();
    }
}

  public static function logout() {
    session_destroy();
    header("location: ../index.php");
}

}

?>