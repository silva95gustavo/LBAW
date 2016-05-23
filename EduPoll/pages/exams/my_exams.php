<?
require_once ('../../config/init.php');
require_once ('../common/utils.php');
require_once ('../../database/exams.php');
include_once ('../common/sidebar.php');

function isOwner($exam) {
	return $_SESSION['userID'] === $exam['ownerid'];
}

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
}
 
$exams = getOwnedAndManagedExams($_SESSION['userID']);

$now = new DateTime();
$now->format('Y-m-d H:i:s');  
$currentTime = date('Y-m-d H:i:s');

prepareDate($smarty);

$smarty->assign ( 'exams', $exams);
$smarty->assign ( 'currentTime', $currentTime);
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/my_exams.tpl' );
?>