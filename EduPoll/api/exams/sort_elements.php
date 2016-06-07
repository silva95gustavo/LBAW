<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');

header('Content-Type: application/json');

if (! isLoggedIn ()) {
	http_response_code(401);
	echo json_encode('You are not logged in.');
	exit ();
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	http_response_code(400);
	echo json_encode('Invalid CSRF token.');
	die ();
}

$exam = getExam($_POST['examid']);
if (!$exam) {
	http_response_code(400);
	echo json_encode('Error fetching exam to edit.');
	exit;
}

if ($exam ['ownerid'] !== $userInfo ['id']) {
	if (!isExamManager($userInfo['id'], $exam['id'])) {
		http_response_code(403);
		echo json_encode('Only the owner/manager of an exam may edit it.');
		exit;
	}
}

if (!isset($_POST["exam-element"])) {
	http_response_code(400);
	echo json_encode("Order array missing in request.");
	exit;
}

$examElements = getExamElementsWithoutParent($exam["id"]);
$orderInput = $_POST["exam-element"];
if (sizeof($orderInput) != sizeof($examElements)) {
	http_response_code(400);
	echo json_encode("Size of the array containing the new order of each exam element differs from the number of exam elements of the exam.");
	exit;
}

if (count($orderInput) !== count(array_unique($orderInput))) {
	http_response_code(400);
	echo json_encode("The array containing the new order of each exam element has repeated elements.");
	exit;
}

// Build order array
for ($i = 0; $i < sizeof($orderInput); $i++) {
	for ($j = 0; $j < sizeof($examElements); $j++) {
		if (!is_numeric($orderInput[$i])) {
			http_response_code(400);
			echo json_encode("Invalid input array.");
			exit;
		}
		if ((int)$orderInput[$i] === $examElements[$j]["id"])
			break;
	}
	if ($j == sizeof($examElements)) {
		http_response_code(400);
		echo json_encode("The array containing the new order of each exam element contains invalid values.");
		exit;
	}
	$order[$i] = $orderInput[$i];
}

try {
	if (!resortExamElements($order)) {
		http_response_code(400);
		echo json_encode('Error reordering exam elements.');
		exit;
	}
	updateExamScore($exam["id"]);
} catch (PDOException $e) {
	http_response_code(400);
	echo json_encode('Error reordering exam elements: ' . $e->getMessage());
	exit;
}

http_response_code(200);
?>