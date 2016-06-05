<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: $BASE_URL" );
	exit;
}

if (! isset($_POST['exam']) || ! isset($_POST['user'])) {
	$_SESSION['error_messages'][] = 'Error fetching exam to edit.';
	http_response_code ( 400 );
	exit;
}

$exam_id = intval($_POST['exam']);
$user = intval($_POST['user']);
$exam = getExam($exam_id);

if ($exam ['ownerid'] !== $userInfo ['id']) {
	$_SESSION['error_messages'][] = 'Only the owner of an exam may add managers to it.';
	http_response_code ( 401 );
	exit;
}
if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION['error_messages'][] = 'CSRF token missing.';
	http_response_code ( 401 );
	exit;
}

if(getExamOwner($exam_id) === $user || isExamManager($user, $exam_id)) {
	$_SESSION ['error_messages'] [] = 'That user already manages this exam.';
	http_response_code (400);
	exit;
}

try {
	if(addManager($exam_id, $user) == -1) {
		$_SESSION['error_messages'][] = 'Error adding manager to exam.';
		http_response_code ( 400 );
		exit;
	}
} catch (PDOException $e) {
	$_SESSION['error_messages'][] = 'Error adding manager to exam: ' . $e->getMessage();
	http_response_code ( 400 );
	exit;
}

$_SESSION['success_messages'][] = 'Manager successfully added.';
http_response_code ( 200 );
?>

