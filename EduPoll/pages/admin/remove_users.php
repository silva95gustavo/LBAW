<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

$perPage = 15;

try{
$users = getUsers($start, $perPage);
}
catch(PDOException $e)
{
	$_SESSION ['error_messages'] [] = "Invalid Page.";
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

$numberOfUsers = getNumberOfUsers();
$numberOfPages = ceil( $numberOfUsers / $perPage );

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1)
	$page = 1;
else if ($page > $numberOfPages)
	$page = $numberOfPages;



$start = ($page - 1) * $perPage;
$users = getUsers($start, $perPage);

prepareDate($smarty);

$smarty->assign ( 'users', $users );
$smarty->assign ( 'numberOfPages', $numberOfPages );
$smarty->assign ( 'currentPage', $page );
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'admin/remove_users.tpl' );

$myArray = array('no' => 10, 'label' => 'Peanuts');
$smarty->assign('foo',$myArray);
?>