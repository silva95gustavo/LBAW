<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: $BASE_URL" );
	exit;
}

if (! isset($_POST['question'])) {
	$_SESSION['error_messages'][] = 'Question ID missing in the request.';
	http_response_code ( 400 );
	exit;
}

$exam = getExamFromExamElement($_POST['question']);

if (!$exam) {
	$_SESSION['error_messages'][] = 'Invalid question ID.';
	http_response_code ( 400 );
	exit;
}

if ($exam ['ownerid'] !== $userInfo ['id'] && !isExamManager($userInfo['id'], $exam["id"])) {
	$_SESSION['error_messages'][] = "You don't have permission to delete a question from this exam.";
	http_response_code ( 403 );
	exit;
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION['error_messages'][] = 'CSRF token missing.';
	http_response_code ( 403 );
	exit;
}

try {
	if(!deleteQuestion($questionid)) {
		$_SESSION['error_messages'][] = 'Error deleting question from exam.';
		http_response_code ( 400 );
		exit;
	}
} catch (PDOException $e) {
	$_SESSION['error_messages'][] = 'Error deleting question from exam: ' . $e->getMessage();
	http_response_code ( 400 );
	exit;
}

$_SESSION['success_messages'][] = 'Question successfully removed.';
header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
?>

