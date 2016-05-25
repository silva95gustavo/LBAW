<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once('../common/sidebar.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
}

prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'users/edit_profile.tpl' );
?>