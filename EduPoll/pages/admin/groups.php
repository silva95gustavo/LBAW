<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
include_once ('../../database/groups.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/admin/main.php' );
	die ();
}

$listing = !isset($_GET['groupID']);

$perPage = 10;

if($listing)
{
	if(!isset($_GET['page']))
		$groups = getGroups(0,$perPage);
	else $groups = getGroups(($_GET['page'] - 1)*$perPage,$perPage);

	$smarty->assign ('groupid', $_GET['groupID']);

}
else{
	$groups = getGroupData($_GET['groupID']);
	if(sizeof($groups) === 0)
	{
		$_SESSION ['error_messages'] [] = "Group does not exist.";
		header ( 'Location: ' . $BASE_URL . 'pages/admin/groups.php' );
		die();
	}
	$smarty->assign ('groupid', $_GET['groupID']);
}

$numberOfGroups = getNumberOfGroups();
$numberOfPages = ceil($numberOfGroups / $perPage);



prepareDate($smarty);

$smarty->assign ('groups', $groups);
$smarty->assign ( 'listing', $listing );
$smarty->assign ( 'numberOfPages', $numberOfPages );
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'admin/groups.tpl' );
?>