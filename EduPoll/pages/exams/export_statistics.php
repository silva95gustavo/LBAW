<?
require_once ('../../config/init.php');
include_once ('../common/utils.php');
include_once ('../common/sidebar.php');
include_once ('../../database/exams.php');

function cleanData(&$str)
{
	$str = preg_replace("/\t/", "\\t", $str);
	$str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

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
	http_response_code(403);
	die ();
}
header("Content-Type: text/plain");
  // filename for download
  /*$filename = "exam_" . $examID . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");*/

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

$examOver = examStatus($examID); //1->over , 2->active, 0->


$groupsAssigned = getAssignedGroups($examID);
$studentsAssigned = getAssignedStudents($examID);
$groupsNotAssigned = getNotAssignedGroups($examID);
$studentsNotAssigned = getNotAssignedStudents($examID);


$line_break = "\r\n";
$paragraph = $line_break . $line_break;
$tab = "\t";

echo "Grade distribution" . $paragraph;
$gradedistexport = [];
for($g = 0; $g <= 20; $g++) {
	$temp = [];
	$temp['Grade'] = $g;
	$temp['Ammount'] = $gradedistribution[$g];
	array_push($gradedistexport, $temp);
}

echo $tab . implode("\t", array_keys($gradedistexport[0])) . "\r\n";
foreach($gradedistexport as $row) {
	array_walk($row, __NAMESPACE__ . '\cleanData');
	echo $tab . implode("\t", array_values($row)) . "\r\n";
}

echo $paragraph . "";


?>