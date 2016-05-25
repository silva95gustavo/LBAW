<?php
  require_once('../../config/init.php');
  require_once ('../../database/exams.php');
  include_once('../common/utils.php');
  include_once('../common/sidebar.php');
  
  if (!isLoggedIn()) {
    header('Location: ' . $BASE_URL . 'pages/auth/login.php');
    die();
  } else if (isAdmin()) {
    header('Location: ' . $BASE_URL . 'pages/admin/main.php');
    die();
  }
  
  $Ongoingexams = getOngoingExams($_SESSION['userID']);
  $Upcomingexams = getUpcomingExams($_SESSION['userID']); 
  $Futureexams = getFutureExams($_SESSION['userID']);

  prepareDate($smarty);
  
  $smarty->assign('name', $_SESSION['name']);
  $smarty->assign('Ongoingexams', $Ongoingexams);
  $smarty->assign('Upcomingexams', $Upcomingexams);
  $smarty->assign('Futureexams', $Futureexams);
  $smarty->display('users/main.tpl');
?>