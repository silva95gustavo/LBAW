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

 if(!isset($_GET['day'])||!isset($_GET['month'])||!isset($_GET['year']))
 {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
 }

 $day = $_GET['day'];
 $month = $_GET['month'];
 $year = $_GET['year'];

 try{
 	$exams = getExamByDate($day,$month,$year,$_SESSION ['userID']);
	$smarty->assign ( 'exams', $exams);
 }
 catch(PDOException $e){
	$_SESSION ['error_messages'] [] = "Invalid Day/Month/Year.";
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
 }
 
 prepareDate($smarty,$day,$month,$year);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/exam_date.tpl' );
?>