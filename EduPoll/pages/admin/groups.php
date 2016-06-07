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
	$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	if($currentPage < 1)
		$currentPage = 1;
	else if($currentPage > $numberOfPages)
		$currentPage = $numberOfPages;
	
	$groups = getGroups(($currentPage - 1)*$perPage,$perPage);
	foreach ($groups as $group) {
		$nstudents[$group['id']] = getStudentsByGroup($group['id']);
	}
	$smarty->assign ('nstudents', $nstudents);
	$smarty->assign ('groups', $groups);
}
else{
	try{
		$groupname = getName($_GET['groupID']);
	}catch ( PDOException $e ) {
		$_SESSION ['error_messages'] [] = "Invalid Group ID.";
		header ( 'Location: ' . $BASE_URL . 'pages/admin/groups.php' );
		die();
	}

	if(!$groupname)
	{
		$_SESSION ['error_messages'] [] = "Group does not exist.";
		header ( 'Location: ' . $BASE_URL . 'pages/admin/groups.php' );
		die();
	}
	$numberOfStudents = getStudentsByGroup($_GET['groupID']);
	$numberOfPages = ceil($numberOfStudents / $perPage);
	if ($numberOfPages == 0)
		$numberOfPages = 1;
	$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	if($currentPage < 1)
		$currentPage = 1;
	else if($currentPage > $numberOfPages)
		$currentPage = $numberOfPages;

	$smarty->assign ('groupname', $groupname);
	$students = getGroupStudents($_GET['groupID'],($currentPage - 1)*$perPage,$perPage);
	$smarty->assign ('students', $students);
}


prepareDate($smarty);

$smarty->assign ('groupid', $_GET['groupID']);
$smarty->assign ( 'listing', $listing );
$smarty->assign ( 'numberOfPages', $numberOfPages );
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->assign ('currentPage', $currentPage);
$smarty->display ( 'admin/groups.tpl' );
?>