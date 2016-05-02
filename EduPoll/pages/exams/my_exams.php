<?
require_once ('../../config/init.php');
require_once ('../common/utils.php');
require_once ('../../database/exams.php');

function isOwner($exam) {
	return $_SESSION['userID'] === $exam['ownerid'];
}

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
}
 
$exams = getOwnedAndManagedExams($_SESSION['userID']);

$datePattern = 'Y-m-d H:i:s';
foreach ($exams as $key => $exam) {
	$startTime = strtotime($exam['starttime']);
	if (is_null($exam['endtime'])) {
		$exams[$key]['startendtime'] = date($datePattern, $startTime) . " - Forever";
		continue;
	}
	else
		$endTime = strtotime($exam['endtime']);
	
	if (date('Y-m-d', $startTime) === date('Y-m-d', $endTime)) {
		$exams[$key]['startendtime'] = date($datePattern, $startTime) . " - " . date('H:i:s', $endTime);
	}
	else
		$exams[$key]['startendtime'] = date($datePattern, $startTime) . " - " . date($datePattern, $endTime);
	
	$exams[$key]['starttime'] = date($datePattern, strtotime($exam['starttime']));
	$exams[$key]['endtime'] = date($datePattern, strtotime($exam['endtime']));
}

$smarty->assign ( 'exams', $exams);
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/my_exams.tpl' );
?>