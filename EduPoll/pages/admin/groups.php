<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

$listing = !isset($_GET['groupID']);

if($listing)
{
	$groups = getGroups();
	$smarty->assign ( 'groups', $groups);
}
else{
	$group = getGroupData($_GET['groupID']);
	$smarty->assign ('group', $group);
}

prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'admin/groups.tpl' );
?>