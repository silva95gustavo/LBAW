<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: $BASE_URL" );
	exit;
}

$attemptID = $_POST['attempt'];
$answerID = $_POST['answer'];

if (! isset($attemptID) || ! isset($answerID) || ! isset($_POST['csrf_token'])) {
	$_SESSION['error_messages'][] = 'Missing information (needs attempt, answer and token).';
	http_response_code ( 400 );
	exit;
}

$userID = $_SESSION ['userID'];

$attempt = getAttempt($attemptID);

if(!isset($attempt)) {
	$_SESSION['error_messages'][] = 'The attempt does not exist.';
	http_response_code ( 400 );
	exit;
}

$answer = getAnswer($answerID);

if(!isset($answer)) {
	$_SESSION['error_messages'][] = 'The answer does not exist.';
	http_response_code ( 400 );
	exit;
}

if($attempt['userid'] !== $userID) {
	$_SESSION['error_messages'][] = 'Only an attempt\'s creator may change it\'s values.';
	http_response_code ( 401 );
	exit;
}

try {
	$temp = editAttemptAnswer(intval($attemptID), intval($answer['questionid']), intval($answerID));
	if(sizeof($temp) < 1) {
		$_SESSION['error_messages'][] = 'Unable to update answer.';
		http_response_code ( 400 );
		exit;
	}
} catch (PDOException $e) {
	$_SESSION['error_messages'][] = 'Unable to update answer.';
	http_response_code ( 500 );
	exit;
}

$_SESSION['success_messages'][] = 'Answer updated.';
http_response_code ( 200 );
echo 'Answer updated successfully';
?>

