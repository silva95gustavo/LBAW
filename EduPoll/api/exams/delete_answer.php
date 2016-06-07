<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');

header('Content-Type: application/json');

if (! isLoggedIn ()) {
	http_response_code(401);
	echo 'You are not logged in.';
	exit ();
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	die ();
}

$exam = getExamFromAnswer($_POST['answer']);
if (!$exam) {
	http_response_code(400);
	echo 'Error fetching exam to edit.';
	exit;
}

if ($exam ['ownerid'] !== $userInfo ['id']) {
	if (!isExamManager($userInfo['id'], $exam["id"])) {
		http_response_code(403);
		echo 'Only the owner/manager of an exam may delete an answer.';
		exit;
	}
}

try {
	if (deleteAnswer($_POST['answer'])) {
		echo json_encode("Answer successfully deleted.");
		exit;
	} else {
		echo "Error adding answer.";
		http_response_code(400);
		exit;
	}
} catch (PDOException $e) {
	http_response_code(400);
	echo 'Error adding answer: ' . $e->getMessage();
	exit;
}
?>