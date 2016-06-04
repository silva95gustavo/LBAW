<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	exit;
}

if (! isset($_POST['question'])) {
	$_SESSION['error_messages'][] = 'Question ID missing in the request.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	exit;
}

$exam = getExamFromExamElement($_POST['question']);

if (!$exam) {
	$_SESSION['error_messages'][] = 'Invalid question ID.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	exit;
}

if ($exam ['ownerid'] !== $userInfo ['id'] && !isExamManager($userInfo['id'], $exam["id"])) {
	$_SESSION['error_messages'][] = "You don't have permission to delete a question from this exam.";
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	exit;
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION['error_messages'][] = 'CSRF token missing.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	exit;
}

try {
	if(!deleteQuestion($_POST['question'])) {
		$_SESSION['error_messages'][] = 'Error deleting question from exam.';
		header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
		exit;
	}
} catch (PDOException $e) {
	$_SESSION['error_messages'][] = 'Error deleting question from exam: ' . $e->getMessage();
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	exit;
}

$_SESSION['success_messages'][] = 'Question successfully removed.';
header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
?>

