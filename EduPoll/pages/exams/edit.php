<?
require_once ('../../config/init.php');
require_once ('../common/utils.php');
require_once ('../../database/exams.php');
include_once ('../common/sidebar.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
}

$examID = $_GET['id'];
$exam = getExam($examID);

if(examStatus($examID) === 1)
{
	$_SESSION ['error_messages'] [] = "The exam has ended, cannot be edited.";
	header ( 'Location: ' . $BASE_URL . 'pages/exams/my_exams.php' );
	die ();
}

if(!isManagerOrOwner($userInfo['id'],$examID))
{
	$_SESSION ['error_messages'] [] = "You do not have permission to edit this exam.";
	header ( 'Location: ' . $BASE_URL . '/pages/exams/my_exams.php' );
	die ();
}

if ($exam)
{
	$exam['id'] = $examID;
	$smarty->assign ( 'exam', $exam);
	$smarty->assign ( 'isOwner', $exam['ownerid'] === $userInfo['id']);
}

prepareDate($smarty);

$smarty->assign ( 'name', $userInfo['name'] );
$smarty->display ( 'exams/edit.tpl' );
?>