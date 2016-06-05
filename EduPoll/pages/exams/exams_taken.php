<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
include_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
 }

 $userid = $_SESSION ['userID'];
 $exams = getUserPreviousExams($userid);
  
 prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->assign ( 'userID',$userid);
$smarty->assign ( 'exams', $exams );
$smarty->display ( 'exams/exams_taken.tpl' );
?>