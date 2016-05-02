<?
require_once ('../../config/init.php');
require_once ('../common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
 }

$exam = getExam($_GET['id']);

$smarty->assign ( 'exam', $exam);
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/edit.tpl' );
?>