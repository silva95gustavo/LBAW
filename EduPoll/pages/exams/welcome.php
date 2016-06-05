<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
require_once ('../../database/exams.php');


if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
	die();
}

$examID = $_GET['id'];
$userID = $_SESSION['userID'];
try{
	if(!wasInvited($userID, $examID))
	{
		$_SESSION ['error_messages'] [] = "You don't have access to that exam";
		header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
		die ();
	}
}catch ( PDOException $e ) {
	$_SESSION ['error_messages'] [] = "Invalid Exam ID";
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

$exam = getExam($examID);

$examStatus = examStatus($examID);

prepareDate($smarty);
$smarty->assign ('userID',$userID);
$smarty->assign ('examStatus',$examStatus);
$smarty->assign ('exam',$exam);
$smarty->assign ('examID',$examID);
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/welcome.tpl' );
?>