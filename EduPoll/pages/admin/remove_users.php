<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'admin/remove_users.tpl' );
?>