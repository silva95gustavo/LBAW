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