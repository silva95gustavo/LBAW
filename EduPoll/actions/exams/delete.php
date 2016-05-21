<?
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: $BASE_URL" );
	exit ();
}

$exam = getExam($_POST['id']);
if (!$exam) {
	$_SESSION ['error_messages'] [] = 'Error fetching exam to delete.';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}
if ($exam ['ownerid'] !== $userInfo ['id']) {
	$_SESSION ['error_messages'] [] = 'Only the owner of an exam may delete it.';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}
if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	die();
}

try {
	deleteExam($_POST['id']);
} catch (PDOException $e) {
	$_SESSION['error_messages'][] = 'Error deleting exam: ' . $e->getMessage();
	header("Location: " . $_SERVER['HTTP_REFERER']);
	exit;
}
$_SESSION['success_messages'][] = 'Exam successfully deleted.';
header("Location: " . $BASE_URL . "pages/exams/my_exams.php");
?>

