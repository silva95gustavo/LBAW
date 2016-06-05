<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
require_once ('../../database/exams.php');

$examID = null;
if (!isset($_GET['id']))
{
	$_SESSION ['error_messages'] [] = "You don't have access to that exam";
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}
else $examID = (int)$_GET['id'];

$exam = getExam($examID);
$invited = false;
if (isset($_GET['inv']))
{
	$hash = $_GET['inv'];
	$data = $exam['id'] . $exam['name'] . $exam['description'] . $exam['starttime'] . $exam['ownerid'];
	if(password_verify($data,$hash))
		$invited = true;
}
if(!$invited) {
	$userID = $_SESSION['userID'];
	if (! isLoggedIn ()) {
		header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
		die ();
	} else if (isAdmin()) {
		header('Location: ' . $BASE_URL . 'pages/admin/main.php');
		die();
	}

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
}



$examStatus = examStatus($examID);

prepareDate($smarty);
$smarty->assign ('invited', $invited);
if(!$invited)
	$smarty->assign ('userID',$userID);
$smarty->assign ('examStatus',$examStatus);
$smarty->assign ('exam',$exam);
$smarty->assign ('examID',$examID);
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/welcome.tpl' );
?>