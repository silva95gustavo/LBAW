<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');

header('Content-Type: application/json');

if (! isLoggedIn ()) {
	http_response_code(401);
	echo 'You are not logged in.';
	exit;
}

$exam = getExam($_POST['id']);
if (!$exam) {
	http_response_code(400);
	echo 'Error fetching exam to edit.';
	exit;
}
if ($exam ['ownerid'] !== $userInfo ['id']) {
	if (!isExamManager($userInfo['id'], $_POST['id'])) {
		http_response_code(401);
		echo 'Only the owner/manager of an exam may edit it\'s description.';
		exit;
	}
}

$reply;

try {
	$reply = editExamDescription($_POST['id'], $_POST['description']);
} catch (PDOException $e) {
	http_response_code(400);
	echo 'Error editing exam description: ' . $e->getMessage();
	exit;
}

http_response_code(200);
echo json_encode($reply);

?>