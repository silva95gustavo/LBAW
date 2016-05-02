<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
}

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'users/edit_profile.tpl' );
?>