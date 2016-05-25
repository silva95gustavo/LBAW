<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->assign ( 'genderValues', array(0 => 'Male', 1 => 'Female') );
$smarty->assign ( 'genderType', 0 );
$smarty->assign ( 'userValues', array(2 => 'Student', 1 => 'Teacher') );
$smarty->assign ( 'userType', 2 );
$smarty->display ( 'admin/add_individual_user.tpl' );
?>