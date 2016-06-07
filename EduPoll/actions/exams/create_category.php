<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: $BASE_URL" );
	exit;
}

if (! isset($_POST['examid'])) {
	$_SESSION['error_messages'][] = 'Exam ID missing in the request.';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

if (! isset($_POST['name'])) {
	$_SESSION['error_messages'][] = 'Statement missing in the request.';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

$exam = getExam($_POST['examid']);
if (!$exam) {
	$_SESSION['error_messages'][] = 'Invalid exam ID.';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

if ($exam ['ownerid'] !== $userInfo ['id'] && !isExamManager($userInfo['id'], $exam["id"])) {
	$_SESSION['error_messages'][] = "You don't have permission to create a category in this exam.";
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION['error_messages'][] = 'CSRF token missing.';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

try {
	if(!createCategory($_POST['examid'], $_POST['name'])) {
		$_SESSION['error_messages'][] = 'Error creating category in this exam.';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
} catch (PDOException $e) {
	$_SESSION['error_messages'][] = 'Error creating category in exam: ' . $e->getMessage();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}

$_SESSION['success_messages'][] = 'Category successfully created.';
header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
?>
