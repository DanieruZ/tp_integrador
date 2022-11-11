<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use DAO\ScheduleDAO as ScheduleDAO;
use DAO\BookDAO as BookDAO;
use DAO\ReviewDAO as ReviewDAO;
use DAO\PetDAO as PetDAO;

use Models\Schedule;
use Models\Person as Person;
use Utils\Utils as Utils;

class KeeperController
{

  private $keeperDAO;

  public function __construct()
  {
    $this->keeperDAO = new KeeperDAO();
    $this->scheduleDAO = new ScheduleDAO();
    $this->bookDAO = new BookDAO();
    $this->reviewDAO = new ReviewDAO();
    $this->petDAO = new PetDAO();
  }

  public function WelcomeView()
  {
    //Utils::checkKeeperSession();

    $user = $_SESSION['keeper'];
    [$keeper] = $user;

    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-welcome.php");
  }

  public function ScheduleView()
  {
    //Utils::checkKeeperSession();

    $this->keeperDAO = new KeeperDAO();
    $this->scheduleDAO = new ScheduleDAO();
    $this->petDAO = new PetDAO();

    $user = $_SESSION['keeper'];
    [$person] = $user;
    $personId = $person->getPersonId();
    $scheduleList = $this->scheduleDAO->getScheduleById($personId);
    $petList = $this->petDAO->getPetType();
    [$pet] = $petList;

    require_once(VIEWS_PATH . "keeper-nav.php");
    require_once(VIEWS_PATH . "keeper-schedule.php");
  }

  public function OwnerScheduleView()
  {
    //Utils::checkOwnerSession();

    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-owner-schedule.php");
  }

  public function OwnerListView()
  {
    //Utils::checkOwnerSession();

    $personList =  $this->keeperDAO->getAllKeeper();
    $scheduleList =  $this->scheduleDAO->getSchedule();

    if (isset($personList)) {
      foreach ($personList as $person) {
        if (isset($scheduleList)) {
          foreach ($scheduleList as $schedule) {
            if ($schedule->getPersonId() == $person->getPersonId()) {

              
              echo "<pre>";
              print_r($person);
              echo "</pre>";
              $reviewDAO = new ReviewDAO();
              $reviewList = $reviewDAO->getReviewById($person->getPersonId());

              if (!empty($reviewList))
                [$review] = $reviewList;
                
              $keeperRate = $reviewDAO->getRateById($person->getPersonId());
              [$rate] = $keeperRate;
            }
          }
        }
      }
    }

 
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function OwnerSearchListView()
  {
    //Utils::checkOwnerSession();

    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $personList =  $this->keeperDAO->getKeeperByAvailableDate($startDate, $endDate);

    $scheduleList = $this->scheduleDAO->getSchedule();
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-search-list.php");
  }

  public function AdminListView()
  {
    //Utils::checkAdminSession();


    require_once(VIEWS_PATH . "admin-nav.php");
    require_once(VIEWS_PATH . "keeper-list.php");
  }

  public function Profile($personId)
  {
    //Utils::checkKeeperSession();       


    $user = $_SESSION['owner'];
    [$person] = $user;
    $ownerId = $person->getPersonId();

    $keeperInfo = $this->keeperDAO->getKeeperById($personId);
    [$keeper] = $keeperInfo;

    $scheduleInfo = $this->scheduleDAO->getScheduleById($personId);
    [$schedule] = $scheduleInfo;

    $petList = $this->petDAO->getMyPet($ownerId);
    if (!empty($petList)) {
      [$pet] = $petList;
    }

    if (isset($petId)) {
      $petInfo = $this->petDAO->getPetById($petId);
      [$petinformation] = $petInfo;
    }


    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-profile.php");
  }

  public function ProfileKeeperPet($personId, $petId)
  {
    //Utils::checkKeeperSession();    

    $user = $_SESSION['owner'];
    [$person] = $user;
    $ownerId = $person->getPersonId();

    $keeperInfo = $this->keeperDAO->getKeeperById($personId);
    [$keeper] = $keeperInfo;

    $scheduleInfo = $this->scheduleDAO->getScheduleById($personId);
    [$schedule] = $scheduleInfo;

    $petList = $this->petDAO->getMyPet($ownerId);
    if (!empty($petList)) {
      [$pet] = $petList;
    }

    if (isset($petId)) {
      $petInfo = $this->petDAO->getPetById($petId);
      [$petinformation] = $petInfo;
    }
    require_once(VIEWS_PATH . "owner-nav.php");
    require_once(VIEWS_PATH . "keeper-profile.php");
  }

  public function GetKeeperByAvailableDate($startDate, $endDate)
  {
    //Utils::checkOwnerSession();

    $this->keeperDAO->getKeeperByAvailableDate($startDate, $endDate);
    $this->OwnerSearchListView();
  }
}
