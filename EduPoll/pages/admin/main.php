<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
include_once ('../../database/users.php');
include_once ('../../database/exams.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->assign ( 'numberOfUsers', getNumberOfUsers() );
$smarty->assign ( 'numberOfStudents', getNumberOfStudents() );
$smarty->assign ( 'numberOfTeachers', getNumberOfTeachers() );
$smarty->assign ( 'numberOfExams', getNumberOfExams() );
$smarty->display ( 'admin/main.tpl' );
?>