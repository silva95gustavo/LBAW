<?php
  require_once('../../config/init.php');
  include_once('../common/utils.php');
  require_once ('../../database/exams.php');
  include_once('../common/sidebar.php');
  
  if (!isLoggedIn()) {
  	header('Location: ' . $BASE_URL . 'pages/auth/login.php');
  	die();
  } else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
  }

  $Ongoingexams = getOngoingExams($userInfo['id']);

  $Upcomingexams = getUpcomingExams($userInfo['id']);

  $Futureexams = getFutureExams($userInfo['id']);

  foreach ($Futureexams as $key => $exam) {
  $startTime = strtotime($exam['starttime']);
  if (is_null($exam['endtime'])) {
    $exams[$key]['startendtime'] = date($datePattern, $startTime) . " - Forever";
    continue;
  }
  else
    $endTime = strtotime($exam['endtime']);
  
  if (date('Y-m-d', $startTime) === date('Y-m-d', $endTime)) {
    $exams[$key]['startendtime'] = date($datePattern, $startTime) . " - " . date('H:i:s', $endTime);
  }
  else
    $exams[$key]['startendtime'] = date($datePattern, $startTime) . " - " . date($datePattern, $endTime);
  
  $exams[$key]['starttime'] = date($datePattern, strtotime($exam['starttime']));
  $exams[$key]['endtime'] = date($datePattern, strtotime($exam['endtime']));
}
  
  prepareDate($smarty);
  
  $smarty->assign('name', $_SESSION['name']);
  $smarty->assign('Ongoingexams', $Ongoingexams);
  $smarty->assign('Upcomingexams', $Upcomingexams);
  $smarty->assign('Futureexams', $Futureexams);
  $smarty->display('users/main.tpl');
?>
