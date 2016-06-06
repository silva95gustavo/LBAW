<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
require_once ('../../database/exams.php');
require_once ('utils.php');

$examID = $_GET['exam'];

if(!isset($examID)) {
	$_SESSION ['error_messages'] [] = "No exam was specified.";
  	header('Location: ' . $_SERVER['HTTP_REFERER']);
  	die();
}

$exam = getExam($examID);

if(!isset($exam) || !$exam['opentopublic']) {
	$_SESSION ['error_messages'] [] = "Unable to retrieve exam.";
  	header('Location: ' . $_SERVER['HTTP_REFERER']);
  	die();
}

$questions = [];

try {
	$questions = generateQuestionsAnonymous($examID);
} catch (Exception $e) {
	$_SESSION ['error_messages'] [] = "Unable to create attempt.";
 		header('Location: ' . $_SERVER['HTTP_REFERER']);
 		die();
}

prepareDate($smarty);

$smarty->assign ( 'exam', $exam );
$smarty->assign ( 'questions', $questions );
$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->display ( 'exams/take.tpl' );
?>
