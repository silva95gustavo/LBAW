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
	$numberOfGroups = getNumberOfGroups();
	$numberOfPages = ceil($numberOfGroups / $perPage);
	if(!isset($_GET['page']) || $_GET['page'] <= 0 || $_GET['page'] > $numberOfPages)
		$groups = getGroups(0,$perPage);
	else $groups = getGroups(($_GET['page'] - 1)*$perPage,$perPage);
	foreach ($groups as $group) {
		$nstudents[$group['id']] = getStudentsByGroup($group['id']);
	}
	$smarty->assign ('nstudents', $nstudents);
	$smarty->assign ('groups', $groups);
}
else{
	$groupname = getName($_GET['groupID']);
	if(!$groupname)
	{
		$_SESSION ['error_messages'] [] = "Group does not exist.";
		header ( 'Location: ' . $BASE_URL . 'pages/admin/groups.php' );
		die();
	}
	$smarty->assign ('groupname', $groupname);
	$students = getGroupStudents($_GET['groupID']);
	$smarty->assign ('students', $students);
}




prepareDate($smarty);

$smarty->assign ('groupid', $_GET['groupID']);
$smarty->assign ( 'listing', $listing );
$smarty->assign ( 'numberOfPages', $numberOfPages );
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'admin/groups.tpl' );
?>