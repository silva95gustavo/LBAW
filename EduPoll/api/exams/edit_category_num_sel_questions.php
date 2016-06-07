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
	http_response_code(400);
	echo 'Invalid CSRF token';
	exit;
}

if (!isset($_POST['category'])) {
	http_response_code(400);
	echo 'Missing argument "category".';
	exit;
}

if (!isset($_POST['numselquestions'])) {
	http_response_code(400);
	echo 'Missing argument "numselquestions".';
	exit;
}

$exam = getExamFromExamElement($_POST['category']);
if (!$exam) {
	http_response_code(400);
	echo 'Error fetching exam to edit.';
	exit;
}

if ($exam ['ownerid'] !== $userInfo ['id']) {
	if (!isExamManager($userInfo['id'], $exam['id'])) {
		http_response_code(401);
		echo 'Only the owner/manager of an exam may change a category\'s number of selected questions.';
		exit;
	}
}

try {
	if (editCategoryNumSelQuestions($_POST['category'], $_POST['numselquestions'])) {
		echo json_encode("Successfully changed number of selected questions");
		exit;
	} else {
		echo "Error editing number of selected questions.";
		http_response_code(400);
		exit;
	}
} catch (PDOException $e) {
	http_response_code(400);
	echo 'Error editing number of selected questions: ' . $e->getMessage();
	exit;
}
?>