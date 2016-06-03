<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
include_once ('../../database/exams.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
 }
 
$examID = $_GET ['examid'];
$userID = $_SESSION['userID'];

if(getExamOwner($examID)[0]['id'] != $userID) {
	$_SESSION ['error_messages'] [] = 'You do not own this exam.';
	header ( "Location: " . $BASE_URL . 'pages/exams/my_exams.php' );
	die ();
}

$exam = getExam($examID);
$stats = getExamStats($examID);
$approvals = getExamApprovals($examID);
$questions = getExamQuestions($examID);
$questionscores = [];

foreach($questions as $question) {
	$questionstats = getQuestionAverageScore($question['id']);
	$questiondata = [];
	if(!$questionstats) {
		$questiondata['id'] = $question['id'];
		$questiondata['statement'] = $question['statement'];
		$questiondata['score'] = "-";
		$questiondata['answers'] = 0;
	} else {
		$questiondata['id'] = $question['id'];
		$questiondata['statement'] = $questionstats['statement'];
		$questiondata['score'] = $questionstats['score'];
		$questiondata['answers'] = $questionstats['answers'];
	}
	array_push($questionscores, $questiondata);
}

if($stats['attempts'] === 0)
	$stats['averagegrade'] = 0;
$stats['approved'] = sizeof($approvals);

$studentstats = getExamStudentGrades($examID);

$gradedistribution = [];
for($g = 0; $g <= 20; $g++) {
	$gradedistribution[$g] = 0;
}
foreach($studentstats as $student) {
	$grade = (int)($student['finalscore']);
	$gradedistribution[$grade]++;
}

prepareDate($smarty);

$smarty->assign ( 'name', $_SESSION ['name'] );
$smarty->assign ( 'exam', $exam );
$smarty->assign ( 'stats', $stats );
$smarty->assign ( 'questionstats', $questionscores );
$smarty->assign ( 'studentstats', $studentstats );
$smarty->assign ( 'gradedistribution', $gradedistribution );
$smarty->display ( 'exams/statistics.tpl' );
?>