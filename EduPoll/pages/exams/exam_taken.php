<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
include_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
 }
 
$attemptid = $_GET['attemptid'];
if(!isset($attemptid)) {
	$_SESSION ['error_messages'] [] = 'That attempt does not exist.';
  	header('Location: ' . $BASE_URL . 'pages/exams/exams_taken.php');
  	die();
}

try{
	$attempt = getAttempt($attemptid);	
}
catch ( PDOException $e ) {
	$_SESSION ['error_messages'] [] = 'Invalid Attempt ID';
  	header('Location: ' . $BASE_URL . 'pages/exams/exams_taken.php');
  	die();
	}
if(!isset($attempt)) {
	$_SESSION ['error_messages'] [] = 'Unable to retrieve attempt.';
  	header('Location: ' . $BASE_URL . 'pages/exams/exams_taken.php');
  	die();
}

$userID = $_SESSION['userID'];
if($userID !== $attempt['userid']) {
	$_SESSION ['error_messages'] [] = 'Only the user who made an attempt can consult it.';
  	header('Location: ' . $BASE_URL . 'pages/exams/exams_taken.php');
  	die();
}

$exam = getExam($attempt['examid']);

if(!$exam['publicgrades'])
{
	$_SESSION ['error_messages'] [] = 'Grades are not available yet.';
  	header('Location: ' . $BASE_URL . 'pages/exams/exams_taken.php');
  	die();
}

$questions = getAttemptQuestions($attemptid);

for($q = 0; $q < sizeof($questions); ++$q) {
	$questions[$q]['answers'] = [];
	
	$answers = getQuestionAnswers($questions[$q]['questionid']);
	if(isset($answers))
		$questions[$q]['answers'] = $answers;
}

prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->assign ( 'attempt', $attempt );
$smarty->assign ( 'questions', $questions );
$smarty->assign ( 'exam', $exam );
$smarty->display ( 'exams/exam_taken.tpl' );
?>