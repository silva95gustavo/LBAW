<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: $BASE_URL" );
	exit;
}

if (! isset($_POST['exam']) || ! isset($_POST['group'])) {
	$_SESSION['error_messages'][] = 'Error fetching exam to edit.';
	http_response_code ( 400 );
	exit;
}

$exam_id = intval($_POST['exam']);
$group = intval($_POST['group']);
$exam = getExam($exam_id);

if(!isset($exam)) {
	$_SESSION['error_messages'][] = 'Error fetching exam to edit.';
	http_response_code ( 400 );
	exit;
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION['error_messages'][] = 'CSRF token missing.';
	http_response_code ( 401 );
	exit;
}

if ($exam ['ownerid'] !== $userInfo ['id'] && !isExamManager($userInfo['id'], $exam_id)) {
	$_SESSION['error_messages'][] = 'Only the owner/manager of an exam may invite users/groups.';
	http_response_code ( 401 );
	exit;
}

if(examIsGroupInvited($exam_id, $group)) {
	$_SESSION['error_messages'][] = 'That group has already been invited.';
	http_response_code ( 400 );
	exit;
}

try {
	if(examInviteGroup($exam_id, $group) == -1) {
		$_SESSION['error_messages'][] = 'Error inviting group to exam.';
		http_response_code ( 400 );
		exit;
	}
} catch (PDOException $e) {
	$_SESSION['error_messages'][] = 'Error inviting group to exam: ' . $e->getMessage();
	http_response_code ( 400 );
	exit;
}

$_SESSION['success_messages'][] = 'Group successfully invited.';
http_response_code ( 200 );
?>

