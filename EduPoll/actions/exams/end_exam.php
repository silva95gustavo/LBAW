<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');

 
  if (!isLoggedIn()) {
  	$_SESSION['error_messages'][] = 'You are not logged in.';
  	header("Location: $BASE_URL");
  	exit;
  }
  
  if (!isAcademic()) {
  	$_SESSION['error_messages'][] = 'You don\'t have permission to create an exam.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }

?>