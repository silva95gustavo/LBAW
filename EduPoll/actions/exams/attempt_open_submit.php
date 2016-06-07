<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

$examID = (int)$_POST['exam'];

if(!isset($examID)) {
	$_SESSION['error_messages'][] = 'Exam not specified.';
	http_response_code ( 400 );
	exit;
}

$qa_pairs = $_POST['answers'];

if(!isset($qa_pairs)) {
	$_SESSION['error_messages'][] = 'Answers not specified.';
	http_response_code ( 400 );
	exit;
}

$exam = getExam($examID);
if(!isset($exam) || !$exam['opentopublic']) {
	$_SESSION['error_messages'][] = 'Invalid exam.';
	http_response_code ( 400 );
	exit;
}

if(sizeof($qa_pairs) === 0) {
	http_response_code ( 200 );
	exit;
}

$starttime = $_POST['date'];

$userID = $_SESSION ['userID'];
if(isset($userID)) {
	try {
		submitOpenAttempt($examID, $starttime, $qa_pairs, $userID);
	} catch (PDOException $e) {
		$_SESSION['error_messages'][] = 'Unable to create attempt (1).';
		http_response_code ( 400 );
		exit;
	}
} else {
	try {
		submitAnonymousAttempt($examID, $starttime, $qa_pairs);
	} catch (PDOException $e) {
		$_SESSION['error_messages'][] = 'Unable to create attempt (2).';
		http_response_code ( 400 );
		exit;
	}
}

$_SESSION['success_messages'][] = 'Attempt successfully submitted.';
http_response_code ( 200 );
?>

