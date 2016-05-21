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
$smarty->display ( 'admin/groups.tpl' );
?>