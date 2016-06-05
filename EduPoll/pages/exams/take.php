<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
require_once ('../../database/exams.php');

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
	
	$smarty->assign ( 'questions', $questions );
}
else					// START NEW ATTEMPT IF POSSIBLE
{
	$userattempts = getPreviousAttempts($userID, $examID);
	if(sizeof($userattempts) >= $exam['maxtries']) {
		$_SESSION ['error_messages'] [] = "Attempt limit has been reached.";
	  	header('Location: ' . $_SERVER['HTTP_REFERER']);
	  	die();
	}
	
	$newAttemptID = createAttempt($userID, $exam['id']);
	
	//generateQuestions($exam, $newAttemptID);
	
	$questions = getQuestionsAndAnswers($newAttemptID);
}
 
prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/take.tpl' );
?>