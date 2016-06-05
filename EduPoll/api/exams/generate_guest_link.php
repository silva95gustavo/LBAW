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

if (!isset($_POST['examID'])) 
{
	$_SESSION['error_messages'][] = 'Error fetching exam to edit.';
	http_response_code ( 400 );
	exit;
}

$examID = (int)$_POST['examID'];

try {
	$exam = getExam($examID);
	$hash = password_hash($exam['id'] . $exam['name'] . $exam['description'] . $exam['starttime'] . $exam['ownerid']);
	echo json_encode($hash);
	exit;
} catch(PDOException $e) {
	$_SESSION['error_messages'][] = 'Error creating the exam link' . $e->getMessage();
	http_response_code ( 400 );
	exit;
}
?>