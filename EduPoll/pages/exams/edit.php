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

if(!isset($_GET['id'])) {
	if (isLoggedIn ()) {
		if(isAcademic()) {
			header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
			die ();
		} else {
  			header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  			die();
		}
	} else {
		header('Location: ' . $BASE_URL . 'pages/auth/login.php');
  		die();
	}
}

$exam = getExam($examID);
$managers = [];
if ($exam)
{
	$exam['id'] = $examID;
	$smarty->assign ( 'exam', $exam);
	$isOwner = $exam['ownerid'] === $userInfo['id'];
	$smarty->assign ( 'isOwner', $isOwner);
	if($isOwner) {
		$managers = getExamManagers($examID);
	} else {
		$managers =getOtherExamManagers($examID, $userInfo['id']);
		$smarty->assign('owner', getExamOwner($examID)[0]);
	}
}

$smarty->assign('managers', $managers);

if(!in_array($userInfo['id'],$managers) && !$isOwner)
	{
	$_SESSION ['error_messages'] [] = "You don't have permission to edit this exam";
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
	}

prepareDate($smarty);

$smarty->assign ( 'name', $userInfo['name'] );
$smarty->display ( 'exams/edit.tpl' );
?>