<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 20;
$start = ($page - 1) * $perPage;

$users = getUsers($start, $perPage);
$numberOfUsers = getNumberOfUsers();
$numberOfPages = ceil($numberOfUsers / $perPage);

$smarty->assign ( 'users', $users );
$smarty->assign ( 'numberOfPages', $numberOfPages );
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'admin/remove_users.tpl' );
?>