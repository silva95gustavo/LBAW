<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
require_once ('../../database/exams.php');
require_once ('utils.php');

function getQuestionsAndAnswers($attemptid) {
	$questions = getAttemptQuestions($attemptid);

	for($q = 0; $q < sizeof($questions); ++$q) {
		$questions[$q]['answers'] = [];

		$answers = getQuestionAnswers($questions[$q]['questionid']);
		if(isset($answers))
			$questions[$q]['answers'] = $answers;
	}

	return $questions;
}

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
}

$examID = $_GET['exam'];
$attemptID = $_GET['attempt'];
$userID = $_SESSION['userID'];

if(!isset($examID)) {
	$_SESSION ['error_messages'] [] = "No exam was specified.";
  	header('Location: ' . $_SERVER['HTTP_REFERER']);
  	die();
}

$exam = getExam($examID);

if(!isset($exam)) {
	$_SESSION ['error_messages'] [] = "Unable to retrieve exam.";
  	header('Location: ' . $_SERVER['HTTP_REFERER']);
  	die();
}

if(isset($attemptID))	// CONTINUE ATTEMPT
{
	$test_ongoing = getOngoingAttempt($userID, $examID);
	if(sizeof($test_ongoing) != 1 || $test_ongoing[0]['id'] != $attemptID) {
		$_SESSION ['error_messages'] [] = "Invalid attempt to take.";
	  	header('Location: ' . $_SERVER['HTTP_REFERER']);
	  	die();
	}

	$questions = getQuestionsAndAnswers($attemptID);
	$attempt = getAttempt($attemptID);

	$smarty->assign ( 'questions', $questions );
	$smarty->assign ( 'attempt', $attempt );
}
else					// START NEW ATTEMPT IF POSSIBLE
{
	// CHECK IF THERE IS AN ONGOING ATTEMPT AND REDIRECT IF THERE IS ONE
	$test_ongoing = getOngoingAttempt($userID, $examID);
	if(sizeof($test_ongoing) == 1) {
		header('Location: ' . $BASE_URL . 'pages/exams/take.php?exam=' . $examID . '&attempt=' . $test_ongoing[0]['id']);
	  	die();
	}
	
	$userattempts = getPreviousAttempts($userID, $examID);
	if(sizeof($userattempts) >= $exam['maxtries']) {
		$_SESSION ['error_messages'] [] = "Attempt limit has been reached.";
	  	header('Location: ' . $_SERVER['HTTP_REFERER']);
	  	die();
	}

	try {
		$newAttemptID = createAttempt($userID, $exam['id']);
		generateQuestions($exam['id'], $newAttemptID);
	} catch (Exception $e) {
		var_dump($e);
		$_SESSION ['error_messages'] [] = "Unable to create attempt.";
  		//header('Location: ' . $_SERVER['HTTP_REFERER']);
  		die();
	}

	header('Location: ' . $BASE_URL . 'pages/exams/take.php?exam=' . $examID . '&attempt=' . $newAttemptID);
	die();
}

prepareDate($smarty);

$smarty->assign ( 'exam', $exam );
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/take.tpl' );
?>
